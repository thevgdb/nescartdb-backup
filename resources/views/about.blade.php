@extends('_layout')

@section('content')
    <div class="headingmain">About NESCartDB Backup</div>

    <img src="{{ asset('images/head_line.gif') }}" alt="" class="line"/>

    <p>NESCartDB Backup is a web application project created by Nick Morgan (VGDB) in 2025. It is a full backup and re-implementation of the wonderful NESCartDB web application made by BootGod, and with data/information/research contributed to it by BootGod and many, many others mostly who are all part of the NESDev Community (https://forums.nesdev.org/). Full credit to them.</p>
    <p>This NESCartDB Backup was created as a pre-emptive measure, to ensure that all the very useful and helpful wealth of information contained in the NES Cart Profiles will never go offline and disappear entirely.</p>

    <p>
        The location of the original NESCartDB project is: <a href="https://nescartdb.com/">https://nescartdb.com/</a>.
    </p>

    <p>
        This backup includes:
        <ul>
            <li>4,599 NES Cart Profiles, which totals 22.9 MB in filesize.</li>
            <li>22,013 Images, which totals 2.44 GB in filesize.</li>
            <li>PHP Source Code</li>
        </ul>
        In total, the full space required is a little bit less than 3 GB. Not bad! This should be pretty easy for you to install a local mirror and get it running in no time! Not too difficult to maintain, either.
    </p>

    <p>
        GitHub: <a href="https://github.com/thevgdb/nescartdb-backup">https://github.com/thevgdb/nescartdb-backup</a>
    </p>
@endsection
