<!DOCTYPE html>

<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<title></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
<link rel="stylesheet" id="css-font-awesome" href="{{ url('backend/assets/css/font-awesome.css') }}" />
<style>
		* {
			box-sizing: border-box;
		}
		body {
			margin: 0;
			padding: 0;
		}

        td { display: block; }
        td.icon { display: inline-block; }
        td.icon a { font-size: 24px; }

		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: inherit !important;
		}

		#MessageViewBody a {
			color: inherit;
			text-decoration: none;
		}

		p { line-height: inherit }

		.desktop_hide,
		.desktop_hide table {
			mso-hide: all;
			display: none;
			max-height: 0px;
			overflow: hidden;
		}

		@media (max-width:620px) {
			.desktop_hide table.icons-inner {
				display: inline-block !important;
			}

			.icons-inner {
				text-align: center;
			}

			.icons-inner td {
				margin: 0 auto;
			}

			.fullMobileWidth,
			.row-content {
				width: 100% !important;
			}

			.image_block img.big {
				width: auto !important;
			}

			.column .border,
			.mobile_hide {
				display: none;
			}

			table {
				table-layout: fixed !important;
			}

			.stack .column {
				width: 100%;
				display: block;
			}

			.mobile_hide {
				min-height: 0;
				max-height: 0;
				max-width: 0;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide,
			.desktop_hide table {
				display: table !important;
				max-height: none !important;
			}
		}
	</style>
</head>
<body style="background-color: #fff; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
    <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff;" width="100%">
        <tbody>
            <tr>
                <td>
                    <!--  header  -->
                    <table align="center" border="0" cellpadding="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #111;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-repeat: no-repeat; background-position: center top; color: #111;  width: 600px;" width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border: 0px;" width="100%">
                                                    <table border="0" cellpadding="0" cellspacing="0" class="image_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td style="padding:0px 18px; width:100%;">
                                                                <div align="center">
                                                                   <h1 style="color:#fff; font-family:sans-serif"><span style="color: #ff4136">{{ App\Setting::getSettingValue('name') }}</span> Watches</h1>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--  content  -->
                    <table align="center" border="0" cellpadding="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9; box-shadow:-2px 2px 2px #ccc;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000; width: 600px;margin-top:28px;" width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border: 0px;" width="100%">
                                                        <h1 style="margin: 0; color: #444; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; font-size: 32px; font-weight: normal; letter-spacing: normal; text-align: center; margin-top: 0; margin-bottom: 0; padding-bottom:4px;padding-top:32px;"><strong>Hello {{ $editor->name }}</strong></h1>
                                                </td>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border: 0px;" width="100%">
                                                    <div style="font-family: sans-serif;padding:16px 30px;">
                                                        <div class="txtTinyMce-wrapper" style="mso-line-height-alt: 25.2px; color: #737487; line-height: 1.8; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
                                                            <p style="margin: 0; font-size: 18px; text-align: center;">Your account successfully created at MS watches store. You now have to verify it and start your work.@if($temp_pass > 0) your password: {{ $temp_pass }} .@endif</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="padding:20px 15px;text-align:center;">
                                                    <div align="center">
                                                        <a href="{{ route('AdminAuth.verify', ['id' => $editor->id, 'hash' => $editor->hash]) }}" style="display:inline-block;color:#fff;cursor:pointer;background-color:#ff4136;border-radius:4px;border:1px solid #ff4136;font-size: 18px;padding:12px 54px;font-family:Arial, Helvetica, sans-serif;text-decoration: none;text-align:center;mso-border-alt:none;word-break:keep-all;">
                                                            Verify Now
                                                        </a>
                                                    </div>
                                                </td>
                                                <td style="border-top: 1px solid #ccc; margin-bottom:22px;margin-left:28px;width:90%;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000; width: 600px;margin-top:-5px;margin-bottom:28px;" width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border: 0px;" width="100%">
                                                    <table border="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                                        <tr>
                                                            <td>
                                                                <div style="font-family: sans-serif">
                                                                    <div class="txtTinyMce-wrapper" style="font-size: 14px; mso-line-height-alt: 25.2px; color: #333; line-height: 1.8; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
                                                                        <p style="margin: 0; font-size: 16px; font-weight: 600; text-align: center; mso-line-height-alt: 32.4px;">Follow us</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0" class="social_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                        <tr>
                                                            <td style="padding: 4px 15px 18px;text-align:center;">
                                                                <table align="center" border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="102px">
                                                                    <tr>
                                                                        <td class="icon" style="padding:0 5px;">
                                                                            <a href="{{ App\Setting::getSettingValue('facebook') }}" target="_blank" style="color: #221fd3">
                                                                                <i class="fa fa-facebook-official"></i>
                                                                            </a>
                                                                        </td>
                                                                        <td class="icon" style="padding:0 5px;">
                                                                            <a href="{{ App\Setting::getSettingValue('twitter') }}" target="_blank" style="color: #61edff">
                                                                                <i class="fa fa-twitter"></i>
                                                                            </a>
                                                                        </td>
                                                                        <td class="icon" style="padding:0 5px;">
                                                                            <a href="{{ App\Setting::getSettingValue('instagram') }}" target="_blank" style="color: #ff4136">
                                                                                <i class="fa fa-instagram"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--  footer  -->
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #111;" width="100%">
                        <tbody>
                            <tr>
                                <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: center; vertical-align: center; padding-top: 0px; padding-bottom: 0px; border: 0px;" width="100%">
                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                        <tr>
                                            <td style="padding: 14px 5px">
                                                <div style="font-family: sans-serif">
                                                    <div class="txtTinyMce-wrapper" style="font-size: 18px; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14.399px; color: #fff; line-height: 1.2;">
                                                    <p style="margin: 10px 0; font-size: 16px; text-align: center;">©{{ date('Y') }} {{ App\Setting::getSettingValue('name') }} Watches | {{ App\Setting::getSettingValue('address') }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table><!-- End -->
</body>
</html>