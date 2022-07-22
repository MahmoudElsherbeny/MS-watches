@extends('emails.layouts.app')

@section('content')

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

@endsection