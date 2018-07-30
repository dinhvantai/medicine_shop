<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{{ __('Created order successfully!') }}</title>
        <meta name="viewport" content="width=device-width" />
           <style type="text/css">
                @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
                    body[yahoo] .buttonwrapper { background-color: transparent !important; }
                    body[yahoo] .button { padding: 0 !important; }
                    body[yahoo] .button a { background-color: #ff6b6b; padding: 15px 25px !important; }
                }

                @media only screen and (min-device-width: 601px) {
                    .content { width: 600px !important; }
                    .col387 { width: 387px !important; }
                }
                .table-order-td {
                    padding: 10px 20px;
                    font-family: Arial, sans-serif;
                    border: 1px solid #fff;
                }

                .table-head-td {
                   padding: 10px 20px;
                   color: #555555;
                   font-family: Arial, sans-serif; 
                   font-size: 20px;
                   line-height: 30px;
                   border-bottom: 1px solid #f6f6f6; 
                }
                p {
                    margin-top: 0px;
                    margin-bottom: 0px;
                }
                .contact-info-recieved {
                    padding: 15px !important;
                }
                .contact-info-recieved strong {
                    font-size: 20px;
                    text-shadow: 2px 1px 1px #ccc;
                    line-height: 2;
                }
                .contact-info-recieved>strong>i {
                    font-size: 22px;
                }
        </style>
    </head>
    <body bgcolor="#f7f7f7" style="margin: 0; padding: 0;" yahoo="fix">
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; border: 1px solid #CDCDCD" class="content">
            <tr>
                <td align="center" bgcolor="#ff6b6b" class="table-head-td" style="font-weight: bold;">
                    {{ __('User feedback') }}
                </td>
            </tr>
            <tr>
                <td class="contact-info-recieved">
                    <strong>{{ __('Contact from ')}}<i>{{ $data['name']}}</i></strong><br/>
                    <span class="contact-email-recieved">
                        <p>{!! __( '<b>Email :</b>' ).$data['email'] !!}</p>
                    </span>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#b8e5cb" class="table-order-td">
                    <span>{{ $data['message'] }}</span>
                </td>
            </tr>
            <tr>
                <td align="center" bgcolor="#dddddd" style="padding: 15px 10px 15px 10px; color: #555555; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
                    <b>{{ __('Framgia Medicine') }}</b>
                </td>
            </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
                </td>
            </tr>
        </table>
        <![endif]-->
    </body>
</html>
