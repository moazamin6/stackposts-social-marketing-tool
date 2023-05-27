<?php

namespace apexl;

use \ForceUTF8\Encoding;

/**
 * PHP class to easily handle CSV files
 *
 * @author Apexl - www.apexlstudios.com
 * @copyright 2019 Apexl
 * @license license.txt The MIT License (MIT)
 * @link https://github.com/N1ghteyes/Easy-PHP-CSV
 *
 * @TODO: many many things. including finish up and produce a release.
 * @TODO allow separate storage of CSV Strings - Memcache / Redis?
 * @Todo add Driver classes for memory management, writing etc.
 */
class EasyCSV
{

    private $path = 'php://temp'; //path location for csv file pointer.
    private $pathInfo; //path info for any loaded csv file
    private $cp; //csv File pointer storage
    private $deliminator; // Deliminator - not changeable after class is instantiated.
    private $storeFilename = 'export.csv';
    private $storePath = 'php://output';
    private $eol = "\r\n"; //allows us to specify a specific EOL for cells that contain new lines.
    private $eolSReplacement = ':@NLINE@:';
    private $enclosure = '"';

    public $loadedFilename;
    public $csvString;
    public $csvArray = array();



    public function __construct()
    {
        //set defaults
        $this->deliminator = $this->setDeliminator();
    }

    /**
     * @param $fileName
     * @return $this
     */
    public function setFileName($fileName){
        $this->storeFilename = $fileName;
        return $this;
    }

    /**
     * Get the loaded filename
     * @return mixed
     */
    public function getFileName(){
        return $this->loadedFilename;
    }

    /**
     * Load a CSV from a file path.
     * @param $path
     * @return $this
     */
    public function loadFromFile($path, $hasHeaders = TRUE){
        $this->setPathInfo($path);
        $this->openFile();
        $this->createArrayFromFile($hasHeaders);
        return $this;
    }

    /**
     * Function setter for $eol
     * @param $eol
     */
    public function setEol($eol){
        $this->eol = $eol;
    }

    /**
     * Function setter for $enclosure
     * @param $enclosure
     */
    public function setEnclosure($enclosure){
        $this->enclosure = $enclosure;
    }

    /**
     * @param bool $hasHeaders
     * @return array
     */
    public function toArray($hasHeaders = TRUE){
        $this->createArrayFromFile($hasHeaders, TRUE);
        return $this->csvArray;
    }

    /**
     * Convert a data array to a csv file.
     * @param $data
     * @param array $headers
     * @param bool $headersInData
     */
    public function arrayToCsv($data, $headers = [], $headersInData = TRUE){
        //to begin with we use php output. We can store permanently later if we want to.
        $this->openFile();
        //headers as keys in data? grab the first row and the keys.
        $hasHeaders = empty($headers) && $headersInData === FALSE ? FALSE : TRUE;
        if($headersInData){
            $firstElement = reset($data);
            //check if we have multiple rows, or just the one.
            $headers = is_array($firstElement) ? array_keys($firstElement) : array_keys($data);
        }

        if($hasHeaders) {
            $this->_processHeader($headers);
        }
        //check if data is a single row, or an array of rows, set accordingly.
        $data = is_string(reset($data)) ? [$data] : $data;
        $this->_processRows($data);
    }

    /**
     * @param $data
     * @param array $headers
     */
    public function appendDataToCsv($data, $headers = []){
        //@todo write this
    }

    /**
     * Function to store the current csv data
     * @return $this|bool
     */
    public function store(){
        if(!$this->storePath){
            //if we dont have a store path, but we do have a path set, assume we're trying to store back to the loaded file.
            if($this->path){
                $this->storePath = $this->path;
            } else {
                //throw error as we can't store this.
                return FALSE;
            }
        }
        //If path isn't set, check if we're working with php output. If not, we need to store to the filename provided.
        if($this->storePath != 'php://output'){
            $this->storePath .= '/'.$this->storeFilename;
        }
        $this->cp = fopen($this->storePath, 'w+'); //open a new file.
        fwrite($this->cp, $this->csvString); //write out the csv string.
        //we dont close the file pointer in case we want to interact with the file again this session
        return $this;
    }

    /**
     * Function to set the new store path.
     * @todo maybe check for directory write?
     * @param $path
     * @return $this
     */
    public function setStorePath($path){
        $this->setPathInfo($path, FALSE);
        return $this;
    }

    /**
     * Method to store path info.
     * @param $path
     * @param bool $loading
     */
    private function setPathInfo($path, $loading = TRUE){
        $this->pathInfo = pathinfo($path);
        if($loading) {
            $this->loadedFilename = $this->pathInfo['filename'];
        } else {
            $this->storeFilename = !empty($this->pathInfo['extension']) ? $this->pathInfo['filename'] . '.' . $this->pathInfo['extension'] : $this->storeFilename;
            $this->storePath = $path;
        }
        $this->path = $path;
    }

    /**
     * Open a local csv file
     * @param bool $allowEditing
     */
    private function openFile($allowEditing = TRUE, $trucateFile = FALSE){
        //force the file to be truncated reguardless.
        if($trucateFile){
            $this->cp = fopen($this->path, 'w+');
        } else {
            //check the mode to open the file.
            if (empty($this->cp)) {
                $mode = $allowEditing ? 'c+' : 'r';
                $this->cp = fopen($this->path, $mode);
                //if we're editing, move the pointer to the end of the file.
                if ($allowEditing) {
                    $this->endOfFile();
                }
            }
        }
    }

    /**
     * Method to move the file pointer to the end of the opened file. allows us to append additional rows etc
     * @return $this
     */
    private function endOfFile(){
        fseek($this->cp, 0, SEEK_END);
        return $this;
    }

    /**
     * allows for lazy / silly deliminators. - because why not.
     * @param $deliminator
     * @return string
     */
    public function setDeliminator($deliminator = ',')
    {
        switch ($deliminator) {
            case 'comma':
            case 'commer':
                $delim = ',';
                break;
            case 'tab':
            case '\t':
                $delim = "\t";
                break;
            default:
                $delim = $deliminator;
        }
        return $delim;
    }

    /**
     * @param $csvHead
     * @param bool|FALSE $start
     * @todo - actually test this works..
     */
    private function _processHeader($csvHead, $start = FALSE)
    {
        if ($start) { //if start is true, add a line to the start of the csv. To do this, we need to create copy any existing data and recreate the file.
            $pos = fgets($this->cp);
            if ($pos != FALSE) { //if false, or 0 we can ignore this.
                $initialfile = file_get_contents($this->path); //load the file contents
                $this->openFile();
                $this->fputcsv($csvHead); //write the header to the top of the new file
                fwrite($this->cp, $initialfile); //add the old file onto the end of the header.
            } else {
                $this->fputcsv($csvHead);
            }
        } else {
            $this->fputcsv($csvHead);
        }
        $this->updateCsvString();
    }

    /**
     * Update the csv string stored by the class.
     */
    private function updateCsvString(){
        $contents = stream_get_contents($this->cp, -1, 0);
        $this->csvString = $contents != FALSE ? $contents : '';
    }

    /**
     * @param $csvArray
     * @return $this
     */
    private function _processRows($csvArray)
    {
        $rows = count($csvArray); //count the rows, allows usage of for loops - much faster than foreach in this context.
        $keys = array_keys($csvArray); //handle non numeric, non 0 arrays.
        for ($i = 0; $i < $rows; ++$i) {
            $this->fputcsv((array)$csvArray[$keys[$i]]); // We typecast to arrays in case we're passed an array of objects.
        }
        $this->updateCsvString();
        return $this;
    }

    /**
     * Set request headers to allow us to download straight to browser
     */
    private function _setExportHeaders()
    {
        if ($this->storePath == 'php://output') {
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename=' . $this->storeFilename);
            header('Pragma: no-cache');
        }
    }

    /**
     * Close the file pointer and end the stream.
     */
    private function _closeFilepointer()
    {
        if(is_resource($this->cp)) {
            fclose($this->cp); //we're outputting to browser so just close the pointer.
        }
    }

    /**
     * Read the file contents and call the string to array method so we can treat a loaded csv file like an array
     * @param $hasHeaders
     */
    private function createArrayFromFile($hasHeaders){
        //if the path is php://output, stream wrappers wont work so try just getting the file contents.
        $this->csvString = $this->path != 'php://output' ? stream_get_contents($this->cp, -1, 0) : file_get_contents($this->path);
        $this->csvStringToArray($this->csvString, $hasHeaders);
    }

    /**
     * Function to process a CSV string into an array. Can split into array by header. By default, headers are sanitised before use so may not match exactly whats been given.
     * @param $string
     * @param bool $hasHeaders
     * @param bool $safeHeaders
     * @return $this
     */
    public function csvStringToArray($string = "", $hasHeaders = FALSE, $safeHeaders = TRUE, $rebuildFileData = FALSE){
        $this->csvString = !empty($string) ? $string : $this->csvString;
        $this->csvArray = array(); //reset this, just in case.
        $headers = array();
        //str_getcsv doesn't allow for new lines in cells. So we need to fudge this a bit.
        $this->csvString = str_replace($this->eol, $this->eolSReplacement, $this->csvString);
        $rows = str_getcsv($this->csvString, $this->deliminator, $this->enclosure);
        if($hasHeaders){
            $unsafeHeaders = str_getcsv(array_shift($rows), $this->deliminator); //get the first row as headers
            if($safeHeaders){
                foreach($unsafeHeaders as $header){
                    $headers[] = trim(strtolower(str_replace(array('/', '\\', ' '), array('_'), $header)));
                }
            } else {
                $headers = $unsafeHeaders;
            }
        }
        $rowNum = count($rows);
        for($i=0; $i < $rowNum; ++$i){
            $this->csvArray[$i] = $this->_processCsvRow($rows[$i], $headers);
        }

        //the last thing we need to do is make sure we have file data opened and built. This will always happen if cp is false.
        if(empty($this->cp) || $rebuildFileData){
            $this->openFile(TRUE, $rebuildFileData);
            $this->arrayToCsv($this->csvArray, $headers, $hasHeaders);
        }

        return $this;
    }

    protected function _processCsvRow($row, $headers = []){
        if((is_string($row))){
            $cellData = str_replace($this->eolSReplacement, $this->eol, $row);
            if(!empty($headers)){
                $data[$headers[0]] = trim($cellData, $this->eol); //trim EOL from the cells.
            } else {
                $data = trim($cellData, $this->eol); //trim EOL from the cells.;
            }
        } else {
            $rowCount = count($row);
            $data = [];
            for($r=0;$r < $rowCount; ++$r) {
                //allow for uneven row lengths
                $cleanData = str_replace($this->eolSReplacement, $this->eol, $row[$r]);
                $cellData = isset($cleanData) ? Encoding::fixUTF8($data, Encoding::ICONV_IGNORE) : '';
                if(isset($headers[$r])){
                    $data[$headers[$r]] = trim($cellData, $this->eol); //trim EOL from the cells.
                } else {
                    $data[] = trim($cellData, $this->eol); //trim EOL from the cells.;
                }
            }
        }
        return $data;
    }

    /**
     * Function to handle the return of the CSV file. either as a string or straight to the browser.
     * @return $this
     */
    public function downloadCsv($asString = FALSE)
    {
        //We're outputting to the browser, so no need to store locally. Simply process and pass the data back
        if ($asString === FALSE) {
            //make sure we have data to output if the data is in temp currently.
            $this->_setExportHeaders();
            if($this->path != 'php://output'){
                //if we have an open pointer, read from it. Otherwise, read from the path.
                $contents = !empty($this->csvString) ? $this->csvString : file_get_contents($this->path);
                file_put_contents('php://output', $contents);
            }
            $this->_closeFilepointer();
            return $this;
        }

        return $this;
    }

    /**
     * Function to allow us to add a row to the end of the file.
     * @param $rows
     * @return $this
     */
    public function addRows($rows)
    {
        //this needs to be a multidimentional array
        $rows = is_array($rows[0]) ? $rows : [$rows];
        $this->openFile();
        $this->_processRows($rows);
        return $this;
    }

    /**
     * Function to get the current csv data as a string.
     * @return bool|string
     */
    public function getCSVString(){
        return $this->csvString;
    }

    /**
     * Function to merge file points (or strings, or both). All files are appended in order to the file passed as the first argument
     * NOTE will preserve headers and append any new ones.
     * @todo - test this.
     * @param $mergedFileName.
     * @param $pointers (e.g. from fopen)
     * @return EasyCSV
     */
    public static function mergeFiles($mergedFileName, ...$pointers){
        //we need to clear temp as we're writing in append mode.
        self::clearPHPTemp();
        $cp = fopen('php://temp', 'a+');
        foreach ($pointers as $file){
            $contents = self::isPointer($file) ? stream_get_contents($file, -1, 0) : $file;
            //writing in a+ mode means we always append.
            fwrite($cp, $contents);
        }
        $mergedString = stream_get_contents($cp, -1, 0);
        fclose($cp);
        self::clearPHPTemp();

        $eaCSV = new EasyCSV();
        $eaCSV->setFileName($mergedFileName);
        $eaCSV->csvStringToArray($mergedString);
        return $eaCSV;
    }

    /**
     * Function to clear the php temp buffer, normally in preperation for file merging.
     * hacky - open php temp, wipe it clean then close the pointer.
     * may not be needed - needs testing.
     */
    public static function clearPHPTemp(){
        $tempPointer = fopen('php://temp', 'w+');
        fclose($tempPointer);
    }

    /**
     * Function to check if the passed var is a file pointer or not.
     * @param $pointer
     * @return bool
     */
    public static function isPointer($pointer){
        if(get_resource_type($pointer) == 'file' || get_resource_type($pointer) == 'stream') {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Function to allow us to specify EOL for fputcsv. Resolved mixing \n in cells with EOL in csv files.
     * @see modified from https://stackoverflow.com/a/21297335
     * @param $data
     * @return bool|int
     */
    private function fputcsv($data) {
        if($data) {
            return fputcsv($this->cp, $data, $this->deliminator, $this->enclosure);
        }
        return FALSE;
    }

    /**
     * Impliments magic __destruct method to close the file pointer.
     */
    public function __destruct()
    {
        $this->_closeFilepointer();
    }
}
