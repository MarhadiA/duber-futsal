<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rapot - {{ $student->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000000;
            font-size: 12px;
            line-height: 1.3;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }

        .header p {
            font-size: 11px;
            color: #333333;
            margin: 5px 0 0 0;
        }

        .student-box {
            background-color: #f2f2f2;
            border: 1px solid #999999;
            padding: 10px;
            margin-bottom: 15px;
        }

        .student-table,
        .period-header-table,
        .summary-table,
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .student-table td {
            border: none;
            padding: 3px;
        }

        .period-title {
            background-color: #111111;
            color: #ffffff;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: bold;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .data-table th {
            background-color: #e6e6e6;
            color: #000000;
            border: 1px solid #444444;
            padding: 6px;
            font-size: 10px;
            text-transform: uppercase;
            text-align: left;
        }

        .data-table td {
            border: 1px solid #444444;
            padding: 6px;
            vertical-align: middle;
        }

        .summary-box {
            background-color: #f9f9f9;
            border: 1px solid #444444;
            border-top: none;
            padding: 8px 10px;
            margin-bottom: 20px;
        }

        .summary-box td {
            border: none;
            padding: 0;
        }

        .footer {
            margin-top: 30px;
            width: 100%;
        }

        .footer td {
            border: none;
            text-align: center;
            width: 50%;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>DUBER FUTSAL AKADEMI</h1>
        <p>Laporan Perkembangan & Penilaian Kompetensi Siswa (E-Rapot)</p>
    </div>

    <!-- Identitas Siswa -->
    <div class="student-box">
        <table class="student-table">
            <tr>
                <td>
                    <span style="font-size: 10px; color: #555;">Nama Siswa:</span><br>
                    <strong style="font-size: 14px;">{{ $student->name }}</strong>
                </td>
                <td style="text-align: right;">
                    <span style="font-size: 10px; color: #555;">Tanggal Cetak:</span><br>
                    <strong style="font-size: 12px;">{{ date('d M Y') }}</strong>
                </td>
            </tr>
        </table>
    </div>

    <!-- Daftar Nilai per Periode -->
    @forelse($gradesByPeriod as $period => $grades)
        <div>
            <!-- Judul Periode -->
            <div class="period-title">
                <table class="period-header-table" style="color: #ffffff;">
                    <tr>
                        <td style="border:none; padding:0;">Periode: {{ $period }}</td>
                        <td style="border:none; padding:0; text-align: right; font-size: 10px; font-weight: normal;">
                            @if ($grades->first()->start_date && $grades->first()->end_date)
                                ({{ date('d M Y', strtotime($grades->first()->start_date)) }} -
                                {{ date('d M Y', strtotime($grades->first()->end_date)) }})
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Tabel Nilai -->
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 8%; text-align: center;">No</th>
                        <th style="width: 52%;">Aspek Penilaian</th>
                        <th style="width: 15%; text-align: center;">Skor</th>
                        <th style="width: 25%;">Pelatih Penilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $index => $grade)
                        <tr>
                            <td style="text-align: center; font-weight: bold; background-color: #ffffff;">
                                {{ $index + 1 }}
                            </td>
                            <td style="font-weight: bold; background-color: #ffffff;">
                                {{ $grade->aspect }}
                            </td>
                            <td
                                style="text-align: center; font-weight: bold; color: #006600; background-color: #ffffff;">
                                {{ $grade->score }}
                            </td>
                            <td style="color: #222222; background-color: #ffffff;">
                                {{ $grade->coach_name ?? 'Pelatih' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Rata-rata & Catatan -->
            <div class="summary-box">
                <table class="summary-table">
                    <tr>
                        <td>
                            <strong style="color: #000;">Catatan Pelatih:</strong>
                            <p style="color: #333; font-style: italic; margin: 3px 0 0 0;">
                                "{{ $grades->first()->notes ?? 'Tidak ada catatan khusus.' }}"</p>
                        </td>
                        <td style="text-align: right; width: 120px;">
                            <span style="font-size: 10px; color: #555;">Rata-rata:</span>
                            <strong
                                style="font-size: 14px; color: #000; margin-left: 5px;">{{ number_format($grades->avg('score'), 1) }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @empty
        <p style="text-align: center; color: #666; padding: 20px;">Belum ada catatan nilai untuk siswa ini.</p>
    @endforelse

    <!-- Tanda Tangan -->
    <table class="footer">
        <tr>
            <td>
                <p style="margin-bottom: 45px;">Orang Tua / Wali Siswa</p>
                <strong>( ........................................ )</strong>
            </td>
            <td>
                <p style="margin-bottom: 45px;">Pelatih / Kepala Akademi</p>
                <strong>( {{ auth()->user()->name ?? 'Administrator' }} )</strong>
            </td>
        </tr>
    </table>

</body>

</html>
