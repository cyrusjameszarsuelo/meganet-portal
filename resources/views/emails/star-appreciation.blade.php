<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>STAR appreciation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 20px;">
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #ffffff; border-radius: 10px; overflow: hidden;">
                    <!-- Header, similar to STAR modal tone -->
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

                    <!-- Dear + thanks section -->
                    <tr>
                        <td style="padding: 20px 24px 8px 24px; font-size: 14px; color: #333333;">
                            <p style="margin: 0 0 8px 0;">Dear <strong>{{ $entry->to_name }}</strong>,</p>
                            <p style="margin: 0 0 12px 0;">{{ $entry->from_name }} just sent you a STAR appreciation.</p>
                            <p style="margin: 0 0 4px 0; font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #999999;">Thank you for</p>
                            <div style="margin: 0 0 8px 0; padding: 10px 12px; border-radius: 8px; background-color: #fff7f6; border: 1px solid #ffd6cf;">
                                {{ $entry->thanks_for }}
                            </div>
                        </td>
                    </tr>

                    @php
                        $selectedValues = $entry->selected_values ?? [];
                        if (is_string($selectedValues)) {
                            $decodedValues = json_decode($selectedValues, true);
                            $selectedValues = is_array($decodedValues) ? $decodedValues : [];
                        }
                    @endphp

                    <tr>
                        <td style="padding: 0 24px 12px 24px; font-size: 13px; color: #333333;">
                            <p style="margin: 0 0 6px 0; font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #999999;">Megawide values demonstrated</p>
                            <div style="margin: 0; padding: 10px 12px; border-radius: 8px; background-color: #fff7f6; border: 1px solid #ffd6cf;">
                                @if (!empty($selectedValues))
                                    {{ implode(', ', $selectedValues) }}
                                @else
                                    None selected
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- STAR combined ST/AR grid -->
                    <tr>
                        <td style="padding: 8px 24px 20px 24px;">
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <!-- Situation & Task (ST) -->
                                    <td width="50%" valign="top" style="padding-right: 6px; padding-bottom: 12px;">
                                        <div style="border-radius: 10px; border: 1px solid #f0f0f0; background-color: #fafafa; padding: 10px 12px;">
                                            <div style="margin-bottom: 6px;">
                                                <span style="display:inline-block;width:22px;height:22px;border-radius:999px;background-color:#ee2f21;color:#ffffff;font-size:12px;line-height:22px;text-align:center;font-weight:bold;margin-right:6px;">ST</span>
                                                <span style="font-weight:bold;font-size:13px;">Situation &amp; Task</span>
                                            </div>
                                            <div style="font-size:13px;color:#444444;line-height:1.4;">
                                                {{ $entry->situation_task ?? trim(($entry->situation ? $entry->situation.' ' : '').($entry->task ?? '')) }}
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Action & Results (AR) -->
                                    <td width="50%" valign="top" style="padding-left: 6px; padding-bottom: 12px;">
                                        <div style="border-radius: 10px; border: 1px solid #f0f0f0; background-color: #fafafa; padding: 10px 12px;">
                                            <div style="margin-bottom: 6px;">
                                                <span style="display:inline-block;width:22px;height:22px;border-radius:999px;background-color:#ee2f21;color:#ffffff;font-size:12px;line-height:22px;text-align:center;font-weight:bold;margin-right:6px;">AR</span>
                                                <span style="font-weight:bold;font-size:13px;">Action &amp; Results</span>
                                            </div>
                                            <div style="font-size:13px;color:#444444;line-height:1.4;">
                                                {{ $entry->action_results ?? trim(($entry->action ? $entry->action.' ' : '').($entry->results ?? '')) }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Prizes / rewards section -->
                    <tr>
                        <td style="padding: 0 24px 8px 24px; font-size: 13px; color: #333333;">
                            <p style="margin: 0 0 4px 0; font-weight: bold;">Earn Stars and exchange them for these amazing items by end of the year:</p>
                            <p style="margin: 0 0 6px 0; font-size: 12px; color:#666666;">5 stars when you receive a commendation &bull; 2 stars when you send a commendation</p>
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td valign="middle" style="padding: 4px 0; width: 70px;">
                                        <img src="{{ asset('images/prizes/ipad.jpg') }}" alt="iPad" style="display:block;width:60px;height:auto;border-radius:6px;">
                                    </td>
                                    <td valign="middle" style="padding: 4px 0; font-size: 13px; color:#333333;">iPad &ndash; <strong>2,000 pts</strong></td>
                                </tr>
                                <tr>
                                    <td valign="middle" style="padding: 4px 0; width: 70px;">
                                        <img src="{{ asset('images/prizes/iwatch.jpeg') }}" alt="iWatch" style="display:block;width:60px;height:auto;border-radius:6px;">
                                    </td>
                                    <td valign="middle" style="padding: 4px 0; font-size: 13px; color:#333333;">iWatch &ndash; <strong>1,500 pts</strong></td>
                                </tr>
                                <tr>
                                    <td valign="middle" style="padding: 4px 0; width: 70px;">
                                        <img src="{{ asset('images/prizes/airpods.jpeg') }}" alt="AirPods" style="display:block;width:60px;height:auto;border-radius:6px;">
                                    </td>
                                    <td valign="middle" style="padding: 4px 0; font-size: 13px; color:#333333;">AirPods &ndash; <strong>500 pts</strong></td>
                                </tr>
                                <tr>
                                    <td valign="middle" style="padding: 4px 0; width: 70px;">
                                        <img src="{{ asset('images/prizes/powerbank.jpg') }}" alt="Power bank" style="display:block;width:60px;height:auto;border-radius:6px;">
                                    </td>
                                    <td valign="middle" style="padding: 4px 0; font-size: 13px; color:#333333;">Power banks &ndash; <strong>300 pts</strong></td>
                                </tr>
                                <tr>
                                    <td valign="middle" style="padding: 4px 0; width: 70px;">
                                        <img src="{{ asset('images/prizes/starbucks gc.jpg') }}" alt="Starbucks GC" style="display:block;width:60px;height:auto;border-radius:6px;">
                                    </td>
                                    <td valign="middle" style="padding: 4px 0; font-size: 13px; color:#333333;">Starbucks GC &ndash; <strong>100 pts</strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 24px 18px 24px; font-size: 11px; color: #999999;">
                            <p style="margin: 14px 0 0 0;">This message was sent from the Meganet STAR appreciation feature.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
