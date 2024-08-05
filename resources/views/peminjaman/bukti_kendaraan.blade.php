<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Peminjaman</title>
    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
            /* border: 1px solid black; */
        }

        body {
            padding: 0px;
            font-size: 14px;
        }

        .logo {
            width: 72px;
            z-index: 500;
            position: fixed;
        }

        .header {
            font-weight: bold;
            font-size: 16px;
        }

        .header-sm {
            font-size: 14px;
        }

        .table-1 .td-1 {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
            vertical-align: top;
        }

        .text-center {
            text-align: center
        }

        .text-header {
            font-size: 18px;
            font-weight: 500;
        }

        .layout-ttd {
            display: inline-flex;
            text-align: center;
        }

        .text-muted {
            font-size: 12px;
            opacity: 80%;
        }

        .catatan {
            font-size: 12px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <img src="{{ asset('storage/uploads/asset/logo-bhamada-sm.png') }}" alt="Bhamada" class="logo">
    <div style="height: 72px; text-align: center;">
        <span class="header">
            UNIVERSITAS BHAMADA SLAWI
            <br>
            UNIT SARANA PRASARANA
        </span>
        <br>
        <span class="header-sm">
            Alamat : Jl. Cut Nyak Dhien No. 16, Kalisapu, Slawi - Kab. Tegal
            <br>
            Telp. (0283)6197570, 6197571 Fax. (0283)6198450
        </span>
    </div>
    <br>
    <hr style="margin: 0px;">
    <br>
    <div style="text-align: center">
        <span style="font-weight: bold; font-size: 16px;">SURAT PEMINJAMAN PRASARANA KENDARAAN DINAS</span>
    </div>
    <br>
    <table style="width: 100%;" class="table-1" cellspacing="0" cellpadding="10">
        <tr>
            <td class="td-1" width="120px">Nama</td>
            <td class="td-1" width="20px" style="text-align: center">:</td>
            <td class="td-1">
                {{ $peminjaman->nama }}
            </td>
        </tr>
        <tr>
            <td class="td-1" width="120px">Hari, Tanggal</td>
            <td class="td-1" width="20px" style="text-align: center">:</td>
            <td class="td-1">
                {{ Carbon\Carbon::parse($peminjaman->tanggal_awal)->translatedFormat('l, d F Y') }}
            </td>
        </tr>
        <tr>
            <td class="td-1" width="120px">Jam Pinjam</td>
            <td class="td-1" width="20px" style="text-align: center">:</td>
            <td class="td-1">
                {{ $peminjaman->jam_awal }}-{{ $peminjaman->jam_akhir }} WIB
            </td>
        </tr>
        <tr>
            <td class="td-1" width="120px">Keperluan</td>
            <td class="td-1" width="20px" style="text-align: center">:</td>
            <td class="td-1">{{ ucfirst($peminjaman->keperluan) }}</td>
        </tr>
        <tr>
            <td class="td-1" width="120px">Uraian Kegiatan</td>
            <td class="td-1" width="20px" style="text-align: center">:</td>
            <td class="td-1">{{ $peminjaman->kegiatan }}</td>
        </tr>
        <tr>
            <td class="td-1" width="120px">Tempat / Tujuan</td>
            <td class="td-1" width="20px" style="text-align: center">:</td>
            <td class="td-1">{{ $peminjaman->keterangan }}</td>
        </tr>
        <tr>
            <td class="td-1" width="120px">Kendaraan</td>
            <td class="td-1" width="20px" style="text-align: center">:</td>
            <td class="td-1">{{ $peminjaman->kendaraan->nama }}</td>
        </tr>
        <tr>
            <td class="td-1" width="120px">Sopir</td>
            <td class="td-1" width="20px" style="text-align: center">:</td>
            <td class="td-1">{{ $peminjaman->sopir->nama }}</td>
        </tr>
        <tr>
            <td colspan="3" class="td-1">
                <div class="catatan">
                    <span>Catatan :</span>
                    <ol style="padding: 0px 16px; margin-top: 0px; margin-bottom: 0px;">
                        <li>
                            Formulir ini merupakan ijin kendaraan keluar dari institusi, apabila sudah ditandatangani
                            pengelola
                        </li>
                        <li>
                            Jika tidak ditandatangani oleh pengelola, security berhak membatalkan keluarnya kendaraan
                        </li>
                        <li>
                            Formulir ini harus di serahkan kepada security sebagai tanda bukti ijin kendaraan keluar
                            dari institusi
                        </li>
                        <li>
                            Formulir ini hanya berlaku satu kali
                        </li>
                    </ol>
                </div>
            </td>
        </tr>
    </table>
    <table style="width: 100%;" cellspacing="0" cellpadding="8">
        <tr>
            <td style="width: 50%;">
                <div class="layout-ttd">
                    <p>&nbsp;</p>
                    <p>Menyetujui,</p>
                    @if ($bauk->ttd)
                        <img src="{{ asset('storage/uploads/' . $bauk->ttd) }}"
                            style="max-width: 74px; max-height: 36px;">
                    @else
                        <br><br>
                    @endif
                    <p style="text-decoration: underline">{{ $bauk->nama }}</p>
                    <p>NIPY : {{ $bauk->nipy }}</p>
                </div>
            </td>
            <td style="width: 50%; padding: 0px 16px; text-align: right;">
                <div class="layout-ttd">
                    <p>Slawi, {{ Carbon\Carbon::today()->translatedFormat('d F Y') }}</p>
                    <p>Pjs. Sarana Prasarana</p>
                    @if ($sarpras->ttd)
                        <img src="{{ asset('storage/uploads/' . $sarpras->ttd) }}"
                            style="max-width: 74px; max-height: 36px;">
                    @else
                        <br><br>
                    @endif
                    <p style="text-decoration: underline">{{ $sarpras->nama }}</p>
                    <p>NIPY : {{ $sarpras->nipy }}</p>
                </div>
            </td>
        </tr>
        <tr style="width: 100%;">
            <td colspan="2" style="text-align: center; padding: 0px 16px;">
                <div class="layout-ttd">
                    <p>Mengetahui,</p>
                    <p>Security,</p>
                    <br><br>
                    <p style="text-decoration: underline">........................................</p>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
