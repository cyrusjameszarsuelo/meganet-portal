<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Your Mega Thank You Card has been sent!</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #ffffff; border-radius: 10px; overflow: hidden;">
                    <tr>
                        <td style="padding: 16px 24px; background-color: #ee2f21; color: #ffffff;">
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td style="font-size: 16px; font-weight: bold;">
                                        &#11088; STAR appreciation
                                    </td>
                                    <td align="right" style="font-size: 12px; opacity: 0.9;">
                                        Meganet portal
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px 24px 24px 24px; font-size: 14px; color: #333333;">
                            <p style="margin: 0 0 10px 0;">Dear <strong>{{ $entry->from_name }}</strong>,</p>
                            <p style="margin: 0 0 10px 0;">Thank you for sending a Mega Thank You Card to <strong>{{ $entry->to_name }}</strong>!</p>
                            <p style="margin: 0 0 10px 0;">Your recognition helps build a culture of appreciation and gratitude based on our IC TIME values.</p>
                            <p style="margin: 0 0 0 0;">You still have <strong>{{ $remainingCommendations }}</strong> out of 3 commendations available to give this month&mdash;keep the appreciation going!</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 24px 18px 24px; font-size: 11px; color: #999999;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
