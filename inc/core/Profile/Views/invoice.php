<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php _e("Invoice")?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style type="text/css">
  * { font-family: DejaVu Sans, sans-serif; }

  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }

  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }

  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }

  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }

  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  }

  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }

  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }

  a {
    color: #1a82e2;
  }

  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  </style>

</head>
<body style="background-color: #fff;">

  <!-- start preheader -->
  <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
    <!-- A preheader is the short summary text that follows the subject line when an email is viewed in the inbox. -->
  </div>
  <!-- end preheader -->

  <!-- start body -->
  <table border="0" cellpadding="0" cellspacing="0" width="100%">

    <!-- start hero -->
    <tr>
      <td align="center" bgcolor="#fff">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 36px 36px 0; font-family: 'Manrope', Helvetica, Arial, sans-serif; ">
              <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;"></h1>
            </td>
          </tr>
        </table>
        <table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="left" valign="top" style="font-size: 0;">
              <div style="display: inline-block; width: 100%; max-width: 50%; min-width: 240px; vertical-align: top;">
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 300px;">
                  <tr>
                    <td align="left" valign="top" style="padding-bottom: 36px; padding-left: 24px; font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                        <p><img src="<?php _ec($logo)?>" alt="Logo" border="0" width="48" style="display: block; height: 48px; width: auto;"></p>
                      <p><?php _ec( get_option("website_title", "#1 Social Media Management & Analysis Platform") )?><br><?php _ec( base_url() )?><br></p>
                    </td>
                  </tr>
                </table>
              </div>
              <div style="display: inline-block; width: 100%; max-width: 50%; min-width: 240px; vertical-align: top;">
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 300px;">
                  <tr>
                    <td align="left" valign="top" style="padding-bottom: 36px; padding-right: 10px; padding-right: 24px; font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                      <p style="font-size: 30px; text-align: right; text-transform: uppercase; color: #0d6efd; margin-bottom: 10px; font-weight: 600;"><?php _e("Invoice")?></p>
                      <p style="text-align: right;">
                        <?php _e("ORDER #")?><?php _ec( str_pad($invoice->id, 5, "0", STR_PAD_LEFT) )?><br>
                        <?php _e( date_show($invoice->created) )?><br>
                      </p>
                    </td>
                  </tr>
                </table>
              </div>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align="center" bgcolor="#ffffff">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
              <p style="margin: 0;"><?php _e("Here is a summary of your recent order. If you have any questions or concerns about your order, please contact us.")?></p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start receipt table -->

          <?php
          $price = $invoice->by==1?$invoice->price_monthly:$invoice->price_annualy;
          $total = $invoice->amount;
          $discount = $total - $price;
          ?>

          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td align="left" bgcolor="#0d6efd" width="75%" style="padding: 12px;font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color: #ffffff;"><strong><?php _e("Item")?></strong></td>
                  <td align="left" bgcolor="#0d6efd" width="25%" style="padding: 12px;font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; color: #ffffff;"><strong><?php _e("Price")?></strong></td>
                </tr>
                <tr>
                  <td align="left" width="75%" style="padding: 12px 12px;font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"><?php _ec( $invoice->plan_name. " - " . ($invoice->by == 2?"Anually":"Monthly") )?></td>
                  <td align="left" width="25%" style="padding: 12px 12px;font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"><?php _ec( get_option("payment_symbol", "$") )?><?php _ec( number_format( $price , 2) )?></td>
                </tr>
                <?php if ($discount < 0): ?>
                <tr>
                  <td align="left" width="75%" style="padding: 12px; font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-top: 2px dashed #0d6efd; border-bottom: 2px dashed #0d6efd;"><strong><?php _e("Discount")?></strong></td>
                  <td align="left" width="25%" style="padding: 12px; font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-top: 2px dashed #0d6efd; border-bottom: 2px dashed #0d6efd;"><strong><span style="color: red;"><?php _ec( get_option("payment_symbol", "$") )?><?php _ec( number_format($discount, 2) )?></span></strong></td>
                </tr>
                <?php endif ?>
                <tr>
                  <td align="left" width="75%" style="padding: 12px; font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-top: 2px dashed #0d6efd; border-bottom: 2px dashed #0d6efd;"><strong><?php _e("Total")?></strong></td>
                  <td align="left" width="25%" style="padding: 12px; font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-top: 2px dashed #0d6efd; border-bottom: 2px dashed #0d6efd;"><strong><?php _ec( get_option("payment_symbol", "$") )?><?php _ec( number_format($total, 2) )?></strong></td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- end reeipt table -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start receipt address block -->
    <tr>
      <td align="center" bgcolor="#0d6efd" valign="top" width="100%">
        <table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="center" valign="top" style="font-size: 0; border-bottom: 3px solid #d4dadf">
              <div style="display: inline-block; width: 100%; max-width: 50%; min-width: 240px; vertical-align: top;">
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 300px;">
                  <tr>
                    <td align="left" valign="top" style="padding-bottom: 36px; padding-left: 36px; padding-right: 20px; font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                      <?php if (get_user_data("bill_owner", "") != "" || get_user_data("bill_tax_number", "") != "" || get_user_data("bill_address", "") != ""): ?>
                          <p><strong style="text-transform: uppercase; color: #0d6efd;"><?php _e("Billing info")?></strong></p>
                          <p>
                            <?php if (get_user_data("bill_owner", "") != ""): ?>
                                <?php _e("Fullname: ")?> <?php _ec( get_user_data("bill_owner", "") )?><br>
                            <?php endif ?>
                            <?php if (get_user_data("bill_tax_number", "") != ""): ?>
                                <?php _e("Tax number: ")?> <?php _ec( get_user_data("bill_tax_number", "") )?><br>
                            <?php endif ?>
                            <?php if (get_user_data("bill_address", "") != ""): ?>
                                <?php _e("Address: ")?> <?php _ec( get_user_data("bill_address", "") )?>
                            <?php endif ?>
                            </p>
                         <?php endif ?>
                    </td>
                  </tr>
                </table>
              </div>
              <div style="display: inline-block; width: 100%; max-width: 50%; min-width: 240px; vertical-align: top;">
                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 300px;">
                  <tr>
                    <td align="left" valign="top" style="padding-bottom: 36px; padding-right: 10px; padding-right: 36px; font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 24px;">
                      <p><strong style="text-transform: uppercase; color: #0d6efd;"><?php _e("Payment info")?></strong></p>
                      <p>
                        <?php _e("Payment method: ")?> <?php _ec( ucfirst($invoice->type) )?><br>
                        <?php _e("Transaction ID: ")?> <?php _ec( $invoice->transaction_id )?><br>
                        <?php _e("Date: ")?> <?php _ec( datetime_show($invoice->created) )?>
                        </p>
                    </td>
                  </tr>
                </table>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align="center" bgcolor="#0d6efd" style="padding: 24px; height: 70px;">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

          <!-- start permission -->
          <tr>
            <td align="center" bgcolor="#0d6efd" style="padding: 12px 30px; font-family: 'Manrope', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #ffffff; font-size: 16px; text-transform: uppercase;">
              <p style="margin: 0;"><?php _e("Thank you for your order!")?></p>
            </td>
          </tr>
          <!-- end permission -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>
</html>