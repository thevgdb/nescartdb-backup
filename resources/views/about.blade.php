@extends('_layout')

@section('content')
    <div class="headingmain">About NESCartDB Backup</div>

    <img src="{{ asset('images/head_line.gif') }}" alt="" class="line"/>

    <p>This is a web application project created by Nick Morgan that is a full and faithful pre-emptive backup measure of the wonderful "NESCartDB" project made by BootGod, and contributed to with data from all sorts of fantastic people, most of which are part of the NESDev Community (https://forums.nesdev.org/). I made this backup as faithful as possible to BootGod's original, with all features working, such as Advanced Search, and all NES Cart Profiles and associated data and images properly backed up and saved, so that this very valuable and useful data will always be available forever! Full credit to everyone else involved like BootGod and the NESDev Community for being the people who actually made this NESCartDB project.</p>

    <p>
        The location of the original NESCartDB is: <a href="https://nescartdb.com/">https://nescartdb.com/</a>.
    </p>

{{--    <p>--}}
{{--        This backup was completed in July 2025. This Backup includes:--}}
{{--        <ul>--}}
{{--            <li>4,599 NES Cart Profiles, which totals 22.9 MB in filesize.</li>--}}
{{--            <li>22,013 Images, which totals 2.44 GB in filesize.</li>--}}
{{--            <li>PHP Source Code</li>--}}
{{--        </ul>--}}
{{--        In total, the full space required is a little bit less than 3 GB. Not bad! This should be pretty easy for you to install a local mirror and get it running in no time! Not too difficult to maintain, either.--}}
{{--    </p>--}}

    <p>This backup was completed in July 2025. This Backup includes:</p>

    <table>
        <thead>
        <tr>
            <th>Item</th>
            <th>Amount</th>
            <th>Filesize</th>
            <th>Info</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>NES Cart Profiles</td>
            <td>4,599</td>
            <td>22.9 MB</td>
            <td></td>
        </tr>
        <tr>
            <td>Images</td>
            <td>22,013</td>
            <td>2.44 GB</td>
            <td></td>
        </tr>
        <tr>
            <td>PHP Source Code</td>
            <td>1</td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <p>In total, the full space required is a little bit less than 3 GB. Not bad! This should be pretty easy for you to install a local mirror and get it running in no time! Not too difficult to maintain, either. Go ahead -- run an instance on your local machine -- I dare you.</p>

    <p>
        GitHub: <a href="https://github.com/thevgdb/nescartdb-backup">https://github.com/thevgdb/nescartdb-backup</a>
    </p>
@endsection
