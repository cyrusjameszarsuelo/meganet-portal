<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>You earned STAR points</title>
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
                        <td style="padding: 20px 24px 12px 24px; font-size: 14px; color: #333333;">
                            <p style="margin: 0 0 10px 0;">Hi <strong>{{ $entry->from_name }}</strong>,</p>
                            <p style="margin: 0 0 10px 0;">Thank you for sending a STAR appreciation to <strong>{{ $entry->to_name }}</strong>.</p>
                            <p style="margin: 0 0 14px 0; font-size: 13px;">You just earned <strong>2 STAR points</strong> for celebrating a teammate.</p>
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

                    <tr>
                        <td style="padding: 0 24px 16px 24px; font-size: 13px; color: #333333;">
                            <p style="margin: 0 0 6px 0; font-size: 12px; text-transform: uppercase; letter-spacing: 0.08em; color: #999999;">You wrote</p>
                            <div style="margin: 0 0 8px 0; padding: 10px 12px; border-radius: 8px; background-color: #fff7f6; border: 1px solid #ffd6cf;">
                                <strong>Thank you for:</strong><br>
                                {{ $entry->thanks_for }}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 24px 18px 24px; font-size: 11px; color: #999999;">
                            <p style="margin: 14px 0 0 0;">This message confirms your STAR submission and points. You earn 5 stars when you receive a commendation, and 2 stars when you send a commendation.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
