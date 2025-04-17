@extends('_layout')

@section('content')
    <div class="headingmain">Advanced Search</div>
    <table class="searchmenu">
        <tr>
            <td id="tab_game" class="tabsel"><a class="tab" onclick="search_box('game')">Game</a></td>
            <td id="tab_roms" class="tab"><a class="tab" onclick="search_box('roms')">ROMs</a></td>
            <td id="tab_cart" class="tab"><a class="tab" onclick="search_box('cart')">Cart / Profile</a></td>
            <td id="tab_pcb" class="tab"><a class="tab" onclick="search_box('pcb')">PCB / Hardware</a></td>
            <!-- <td id="tab_chips" class="tab"><a class="tab" onclick="search_box('chips')">Chips</a></td>
            <td id="tab_properties" class="tab"><a class="tab" onclick="search_box('properties')">Properties</a></td> -->
            <td class="tab"><input type="button" value="Reset" onclick="return popup('clear_search.html', 'clearsearch')"><span id="modind" class="notmod">&nbsp;Modified</span></td>
        </tr>
    </table>
    <form action="https://nescartdb.com/search/advanced" name="frmASearch" method="get" onsubmit=" return selectAllFields()">
        <table class="sideboxcontent">
            <tr valign="top">
                <td>
                    <table id="sb_game">
                        <tr>
                            <td>Game Title:</td>
                            <td>
                                <select name="title_op" style="width: 120px;">
                                    <option value="contains">Contains</option>
                                    <option value="starts">Starts w/</option>
                                    <option value="ends">Ends w/</option>
                                    <option value="not_like">Not Like</option>
                                    <option value="any">Any word</option>
                                    <option value="all">All words</option>
                                    <option value="exact">Exact match</option>
                                </select>
                            </td>
                            <td><input type="text" name="title" maxlength="64" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>Region:</td>
                            <td>
                                <select name="region_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td>
                                <select name="region" onchange="field_changed(this.name)">
                                    <option value="">&lt;Any&gt;</option>
                                    <option>Australia</option>
                                    <option>Brazil</option>
                                    <option>Canada</option>
                                    <option>Europe</option>
                                    <option>France</option>
                                    <option>Germany</option>
                                    <option>Italy</option>
                                    <option>Japan</option>
                                    <option>Netherlands</option>
                                    <option>Scandinavia</option>
                                    <option>South Korea</option>
                                    <option>Spain</option>
                                    <option>Sweden</option>
                                    <option>Taiwan</option>
                                    <option>United Kingdom</option>
                                    <option>USA</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Catalog ID:</td>
                            <td>
                                <select name="catalog_op" style="width: 120px;">
                                    <option value="contains">Contains</option>
                                    <option value="starts">Starts w/</option>
                                    <option value="ends">Ends w/</option>
                                    <option value="not_like">Not Like</option>
                                    <option value="any">Any word</option>
                                    <option value="all">All words</option>
                                    <option value="exact">Exact match</option>
                                </select>
                            </td>
                            <td><input type="text" name="catalog" maxlength="255" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>Video System:</td>
                            <td>
                                <select name="system_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td>
                                <select name="system" onchange="field_changed(this.name)">
                                    <option value="">&lt;Any&gt;</option>
                                    <option>NTSC</option>
                                    <option>PAL-A</option>
                                    <option>PAL-B</option>
                                    <option>PAL</option>
                                </select>
                            </td>
                        </tr><!--
                <tr>
                  <td>Release Date:</td>
                  <td>
                    <select name="released_op" style="width: 120px;">
                      <option value="on">On</option>
                      <option value="not_on">Not on</option>
                      <option value="after">After</option>
                      <option value="before">Before</option>
                      <option value="on_or_after">On or after</option>
                      <option value="on_or_before">On or before</option>
                    </select>
                  </td>
                  <td><input type="text" name="released" maxlength="10" value="" onchange="field_changed(this.name)"></td>
                </tr> -->
                        <tr>
                            <td>Class:</td>
                            <td>
                                <select name="class_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td>
                                <select name="class" onchange="field_changed(this.name)">
                                    <option value="">&lt;Any&gt;</option>
                                    <option>Licensed</option>
                                    <option>Unlicensed</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>SubClass:</td>
                            <td>
                                <select name="subclass_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td>
                                <select name="subclass" onchange="field_changed(this.name)">
                                    <option value="">&lt;Any&gt;</option>
                                    <option>3rd-Party</option>
                                    <option>Competition</option>
                                    <option>Multi-cart</option>
                                    <option>Normal</option>
                                    <option>Test Cart</option>
                                    <option>Unreleased</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Publisher:</td>
                            <td>
                                <select name="publisher_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td>
                                <select name="publisher" onchange="field_changed(this.name)">
                                    <option value="">&lt;Any&gt;</option>
                                    <option>A Wave</option>
                                    <option>Absolute</option>
                                    <option>Acclaim</option>
                                    <option>Active Enterprises</option>
                                    <option>Activision</option>
                                    <option>AGCI</option>
                                    <option>Altron</option>
                                    <option>American Softworks</option>
                                    <option>Angel</option>
                                    <option>Arcadia</option>
                                    <option>ASCII</option>
                                    <option>Asmik</option>
                                    <option>Athena</option>
                                    <option>Atlus</option>
                                    <option>AVE</option>
                                    <option>Bandai</option>
                                    <option>Banpresto</option>
                                    <option>Beam Software</option>
                                    <option>Bothtec (Quest)</option>
                                    <option>Brøderbund</option>
                                    <option>Bullet-Proof Software</option>
                                    <option>Bunch Games</option>
                                    <option>Caltron</option>
                                    <option>Camerica</option>
                                    <option>Capcom</option>
                                    <option>CBS / Sony Group</option>
                                    <option>CCE</option>
                                    <option>Character Soft</option>
                                    <option>Coconuts</option>
                                    <option>Codemasters</option>
                                    <option>Color Dreams</option>
                                    <option>Culture Brain</option>
                                    <option>Data East</option>
                                    <option>dB-SOFT</option>
                                    <option>Electro Brain</option>
                                    <option>Electronic Arts</option>
                                    <option>Elite</option>
                                    <option>Enix</option>
                                    <option>Epic / Sony Records</option>
                                    <option>Epoch</option>
                                    <option>Face</option>
                                    <option>FCI</option>
                                    <option>Fuji TV</option>
                                    <option>Gakken</option>
                                    <option>Galoob</option>
                                    <option>GameTek</option>
                                    <option>Gluk Video</option>
                                    <option>GO 1</option>
                                    <option>Gradiente</option>
                                    <option>Gremlin</option>
                                    <option>HAL Laboratory</option>
                                    <option>Hect</option>
                                    <option>HES</option>
                                    <option>Hi Tech Expressions</option>
                                    <option>Hi-Score Software</option>
                                    <option>HOT・B</option>
                                    <option>Hudson Soft</option>
                                    <option>Human Entertainment</option>
                                    <option>Hyundai Electronics Industries Co., Ltd.</option>
                                    <option>I'Max</option>
                                    <option>IGS</option>
                                    <option>Imagineer</option>
                                    <option>Infocom</option>
                                    <option>Infogrames</option>
                                    <option>INTV</option>
                                    <option>Irem</option>
                                    <option>Jaleco</option>
                                    <option>Jingukan</option>
                                    <option>JVC</option>
                                    <option>KAC</option>
                                    <option>Kawada</option>
                                    <option>Kemco</option>
                                    <option>King Records</option>
                                    <option>Koei</option>
                                    <option>Konami</option>
                                    <option>Kyugo Boueki</option>
                                    <option>LJN</option>
                                    <option>Login Soft</option>
                                    <option>Loriciel</option>
                                    <option>M&amp;M</option>
                                    <option>Masaya</option>
                                    <option>Matchbox</option>
                                    <option>Mattel</option>
                                    <option>Meldac</option>
                                    <option>Microprose</option>
                                    <option>Milton Bradley</option>
                                    <option>Mindscape</option>
                                    <option>Namco</option>
                                    <option>Natsume</option>
                                    <option>Nexoft</option>
                                    <option>Nichibutsu</option>
                                    <option>Nintendo</option>
                                    <option>NTVIC</option>
                                    <option>Ocean</option>
                                    <option>Pack-In-Video</option>
                                    <option>Palcom</option>
                                    <option>Panesian</option>
                                    <option>Parker Brothers</option>
                                    <option>Party Room 21</option>
                                    <option>Pixel</option>
                                    <option>Pony Canyon</option>
                                    <option>RacerMate</option>
                                    <option>Rix Soft</option>
                                    <option>Romstar</option>
                                    <option>Sachen / Joy Van</option>
                                    <option>Sammy</option>
                                    <option>Sanritsu</option>
                                    <option>SEI</option>
                                    <option>Seta</option>
                                    <option>Sharp</option>
                                    <option>Shinsei</option>
                                    <option>Sigma Enterprises</option>
                                    <option>SNK</option>
                                    <option>Sofel</option>
                                    <option>Soft Pro</option>
                                    <option>Sony (CSG) Imagesoft</option>
                                    <option>Square</option>
                                    <option>Storm</option>
                                    <option>Sunsoft</option>
                                    <option>Taito</option>
                                    <option>Takara</option>
                                    <option>Taxan</option>
                                    <option>Technos</option>
                                    <option>Tecmo</option>
                                    <option>Tengen</option>
                                    <option>The Software Toolworks</option>
                                    <option>THQ</option>
                                    <option>Titus</option>
                                    <option>Toei Animation</option>
                                    <option>Toemiland</option>
                                    <option>Toho</option>
                                    <option>Tokuma Shoten</option>
                                    <option>Tokyo Shoseki</option>
                                    <option>Tomy</option>
                                    <option>Tonkin House</option>
                                    <option>Towa Chiki</option>
                                    <option>Tradewest</option>
                                    <option>Triffix</option>
                                    <option>TSS</option>
                                    <option>UBI Soft</option>
                                    <option>Ultra Games</option>
                                    <option>Use</option>
                                    <option>Vap</option>
                                    <option>Varie</option>
                                    <option>Vic Tokai</option>
                                    <option>Victor</option>
                                    <option>Virgin Games</option>
                                    <option>Visco</option>
                                    <option>Wisdom Tree</option>
                                    <option>Yutaka</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Developer:</td>
                            <td>
                                <select name="developer_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td>
                                <select name="developer" onchange="field_changed(this.name)">
                                    <option value="">&lt;Any&gt;</option>
                                    <option>A.I</option>
                                    <option>Accolade</option>
                                    <option>Active Enterprises</option>
                                    <option>Activision</option>
                                    <option>Advance Communication</option>
                                    <option>AGCI</option>
                                    <option>Aicom</option>
                                    <option>AIM</option>
                                    <option>Aisystem Tokyo</option>
                                    <option>Alfa System</option>
                                    <option>Alpha Denshi</option>
                                    <option>Anco</option>
                                    <option>Another</option>
                                    <option>Arc System Works</option>
                                    <option>Arena Graphics</option>
                                    <option>Artech</option>
                                    <option>ASCII</option>
                                    <option>Atelier Double</option>
                                    <option>Athena</option>
                                    <option>Atlus</option>
                                    <option>Audiogenic Software</option>
                                    <option>AVE</option>
                                    <option>Beam Software</option>
                                    <option>Bethesda Softworks</option>
                                    <option>Birthday</option>
                                    <option>Bit Corp</option>
                                    <option>Bit Managers</option>
                                    <option>Bitmap Brothers</option>
                                    <option>Bitmasters</option>
                                    <option>Bits Laboratory</option>
                                    <option>BITS Studios</option>
                                    <option>Bothtec (Quest)</option>
                                    <option>Braben &amp; Bell</option>
                                    <option>Brain Grey</option>
                                    <option>Brøderbund</option>
                                    <option>Bullet-Proof Software</option>
                                    <option>C &amp; E</option>
                                    <option>C-lab.</option>
                                    <option>Caltron</option>
                                    <option>Capcom</option>
                                    <option>Carry Lab</option>
                                    <option>CBS / Sony Group</option>
                                    <option>Character Soft</option>
                                    <option>Chatnoir</option>
                                    <option>Chunsoft</option>
                                    <option>Cinemaware</option>
                                    <option>Codemasters</option>
                                    <option>Color Dreams</option>
                                    <option>Compile</option>
                                    <option>Crux</option>
                                    <option>Culture Brain</option>
                                    <option>Cyclone System</option>
                                    <option>Dark Technologies</option>
                                    <option>Data East</option>
                                    <option>dB-SOFT</option>
                                    <option>Distinctive Software</option>
                                    <option>DMA Design</option>
                                    <option>Dynamix</option>
                                    <option>Eastridge Technology</option>
                                    <option>Edge Computers</option>
                                    <option>EIM</option>
                                    <option>Electronic Arts</option>
                                    <option>Elite</option>
                                    <option>Enigma Variations</option>
                                    <option>Epoch</option>
                                    <option>Epyx</option>
                                    <option>Equilibrium</option>
                                    <option>Eurocom</option>
                                    <option>Exidy</option>
                                    <option>FarSight Technologies</option>
                                    <option>First Star Software</option>
                                    <option>Free Fall Associates</option>
                                    <option>Game Arts</option>
                                    <option>Game Freak</option>
                                    <option>Game Studio</option>
                                    <option>GameTek</option>
                                    <option>Gottlieb</option>
                                    <option>Graftgold</option>
                                    <option>Graphic Research</option>
                                    <option>Gray Matter</option>
                                    <option>Gremlin</option>
                                    <option>HAL Laboratory</option>
                                    <option>Hect</option>
                                    <option>Hewson</option>
                                    <option>Home Data</option>
                                    <option>HOT・B</option>
                                    <option>Hudson Soft</option>
                                    <option>Human Entertainment</option>
                                    <option>HummingBird Soft</option>
                                    <option>Hyperware</option>
                                    <option>Icom Simulations</option>
                                    <option>Idea-Tek</option>
                                    <option>Imagineering</option>
                                    <option>Incredible Technologies</option>
                                    <option>Infinity</option>
                                    <option>Interlink</option>
                                    <option>Interplay</option>
                                    <option>Irem</option>
                                    <option>ISCO</option>
                                    <option>Jaleco</option>
                                    <option>Japan System House</option>
                                    <option>Japan System Supply</option>
                                    <option>Kawada</option>
                                    <option>KAZe</option>
                                    <option>Kemco</option>
                                    <option>KID</option>
                                    <option>King Records</option>
                                    <option>KLON</option>
                                    <option>Koei</option>
                                    <option>Kogado Studio</option>
                                    <option>Konami</option>
                                    <option>Leland</option>
                                    <option>Lenar</option>
                                    <option>Loriciel</option>
                                    <option>LucasFilm Games</option>
                                    <option>Make Software</option>
                                    <option>Marionette</option>
                                    <option>Masaya</option>
                                    <option>Mass Tael</option>
                                    <option>MegaSoft</option>
                                    <option>Micheal Crick</option>
                                    <option>MicroGraphicImage</option>
                                    <option>Micronics / Khaos</option>
                                    <option>Microprose</option>
                                    <option>Midway</option>
                                    <option>Mighty Craft</option>
                                    <option>Mind's Eye</option>
                                    <option>Mindscape</option>
                                    <option>Motivetime</option>
                                    <option>Musical Plan</option>
                                    <option>Namco</option>
                                    <option>Natsume</option>
                                    <option>New World Computing</option>
                                    <option>Nichibutsu</option>
                                    <option>Nihon Falcom</option>
                                    <option>Nintendo</option>
                                    <option>NMK</option>
                                    <option>NMS Software</option>
                                    <option>Novotrade</option>
                                    <option>Now Production</option>
                                    <option>Ocean</option>
                                    <option>Odyssey Software</option>
                                    <option>Office Koukan</option>
                                    <option>Opera House</option>
                                    <option>Origin Systems</option>
                                    <option>Outback</option>
                                    <option>Ozark Softscape</option>
                                    <option>Pack-In-Video</option>
                                    <option>Pandora Box</option>
                                    <option>Pax Softnica</option>
                                    <option>Piccari Games</option>
                                    <option>Pixel</option>
                                    <option>Pony Canyon</option>
                                    <option>Probe</option>
                                    <option>RacerMate</option>
                                    <option>Radiance Software</option>
                                    <option>Radical Entertainment</option>
                                    <option>Rainbow Arts</option>
                                    <option>Random House</option>
                                    <option>Rare</option>
                                    <option>Realtime Associates</option>
                                    <option>Red Company</option>
                                    <option>Riverhill Soft</option>
                                    <option>Rocket Science Productions</option>
                                    <option>Sachen / Joy Van</option>
                                    <option>Sakata SAS</option>
                                    <option>Sammy</option>
                                    <option>Sanritsu</option>
                                    <option>Scap Trust</option>
                                    <option>Scitron</option>
                                    <option>Sculptured Software</option>
                                    <option>Sega</option>
                                    <option>Seta</option>
                                    <option>Shimada Kikaku</option>
                                    <option>Shouei System</option>
                                    <option>Sierra</option>
                                    <option>Sir-Tech Software</option>
                                    <option>SNK</option>
                                    <option>Sofel</option>
                                    <option>Soft Machine</option>
                                    <option>Soft Vision</option>
                                    <option>Softie</option>
                                    <option>Software Creations</option>
                                    <option>Source</option>
                                    <option>Spidersoft</option>
                                    <option>Square</option>
                                    <option>Strategic Simulations</option>
                                    <option>Sunsoft</option>
                                    <option>Synapse Software</option>
                                    <option>System 3</option>
                                    <option>SystemSoft</option>
                                    <option>T &amp; E Soft</option>
                                    <option>TAD</option>
                                    <option>Taito</option>
                                    <option>Takara</option>
                                    <option>Takeru</option>
                                    <option>Tamtex</option>
                                    <option>Technos</option>
                                    <option>Tecmo</option>
                                    <option>Tengen</option>
                                    <option>The Assembly Line</option>
                                    <option>The Software Toolworks</option>
                                    <option>Thinking Rabbit</option>
                                    <option>Tierheit</option>
                                    <option>Tiertex</option>
                                    <option>Titus</option>
                                    <option>Toaplan</option>
                                    <option>Toho</option>
                                    <option>TOSE Software</option>
                                    <option>Trilobyte</option>
                                    <option>Twilight</option>
                                    <option>TXC Corp</option>
                                    <option>UPL</option>
                                    <option>Use</option>
                                    <option>Varie</option>
                                    <option>Vic Tokai</option>
                                    <option>Virgin Games</option>
                                    <option>Visco</option>
                                    <option>Western Technologies</option>
                                    <option>Westone</option>
                                    <option>Westwood Associates</option>
                                    <option>Will Harvey</option>
                                    <option>Will Wright</option>
                                    <option>Williams Entertainment</option>
                                    <option>Winky Soft</option>
                                    <option>Wisdom Tree</option>
                                    <option>Woodplace</option>
                                    <option>Zap</option>
                                    <option>Zippo Games</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Porter:</td>
                            <td>
                                <select name="porter_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td>
                                <select name="porter" onchange="field_changed(this.name)">
                                    <option value="">&lt;Any&gt;</option>
                                    <option>A Wave</option>
                                    <option>A.I</option>
                                    <option>Advance Communication</option>
                                    <option>AGCI</option>
                                    <option>Atelier Double</option>
                                    <option>Beam Software</option>
                                    <option>Bitmasters</option>
                                    <option>Bits Laboratory</option>
                                    <option>BITS Studios</option>
                                    <option>Bothtec (Quest)</option>
                                    <option>Bullet-Proof Software</option>
                                    <option>Compile</option>
                                    <option>Distinctive Software</option>
                                    <option>Enigma Variations</option>
                                    <option>Eurocom</option>
                                    <option>Gakken</option>
                                    <option>Game Studio</option>
                                    <option>Gremlin</option>
                                    <option>HAL Laboratory</option>
                                    <option>Home Data</option>
                                    <option>Hudson Soft</option>
                                    <option>Human Entertainment</option>
                                    <option>Infinity</option>
                                    <option>Irem</option>
                                    <option>Jaleco</option>
                                    <option>Kemco</option>
                                    <option>Konami</option>
                                    <option>Marionette</option>
                                    <option>Micronics / Khaos</option>
                                    <option>NMK</option>
                                    <option>NMS Software</option>
                                    <option>Novotrade</option>
                                    <option>Ocean</option>
                                    <option>Pixel</option>
                                    <option>Pony Canyon</option>
                                    <option>Rare</option>
                                    <option>Sakata SAS</option>
                                    <option>Sammy</option>
                                    <option>Sanritsu</option>
                                    <option>Sculptured Software</option>
                                    <option>Sofel</option>
                                    <option>Software Creations</option>
                                    <option>Sunsoft</option>
                                    <option>Taito</option>
                                    <option>Tengen</option>
                                    <option>The Sales Curve</option>
                                    <option>Toho</option>
                                    <option>TOSE Software</option>
                                    <option>Visco</option>
                                    <option>Visual Concepts</option>
                                    <option>Zippo Games</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Players:</td>
                            <td>
                                <select name="players_op" style="width: 120px;">
                                    <option value="equal">Equal to</option>
                                    <option value="not_equal">Not equal to</option>
                                    <option value="more_than">More than</option>
                                    <option value="less_than">Less than</option>
                                    <option value="more_than_equ">More than or equal</option>
                                    <option value="less_than_equ">Less than or equal</option>
                                </select>
                            </td>
                            <td><input type="text" name="players" maxlength="2" value="" onchange="field_changed(this.name)"></td>
                        </tr><!--
                <tr valign="top">
                  <td>Peripherals:</td>
                  <td>
                    <select name="peripherals_op" style="width: 120px;">
                      <option value="any">Include Any</option>
                      <option value="all">Include All</option>
                      <option value="exclude">Exclude All</option>
                    </select>
                  </td>
                  <td>
                    <select name="peripherals[]" multiple class="multi" onchange="field_changed(this.name)">
                      <option value="">&lt;Any&gt;</option>
                      <option value="3dglasses">3-D Glasses</option>
                      <option value="aladdin">Aladdin Deck Enhancer</option>
                      <option value="arkanoid">Vaus Controller</option>
                      <option value="barcodeworld">Barcode Battler</option>
                      <option value="battlebox">Battle Box</option>
                      <option value="datach">Datach Joint ROM System</option>
                      <option value="famicom">Famicom Controller</option>
                      <option value="familyfunfitness">Family Fun Fitness Mat</option>
                      <option value="familykeyboard">Family Keyboard</option>
                      <option value="familytrainer">Family Trainer Mat</option>
                      <option value="fourplayer">4-Player Adapter</option>
                      <option value="karaoke">Karaoke Studio</option>
                      <option value="konamihypershot">Konami HyperShot</option>
                      <option value="mahjong">Mahjong Controller</option>
                      <option value="miraclepiano">Miracle Piano</option>
                      <option value="oekakids">Oeka Kids Tablet</option>
                      <option value="pachinko">Pachinko Controller</option>
                      <option value="partytap">Party Tap</option>
                      <option value="powerglove">Power Glove</option>
                      <option value="powerpad">Power Pad</option>
                      <option value="racermate">RacerMate Bike</option>
                      <option value="rob">R. O. B.</option>
                      <option value="standard">NES Controller</option>
                      <option value="topriderbike">Top Rider Bike</option>
                      <option value="turbofile">TurboFile</option>
                      <option value="uforce">U-Force</option>
                      <option value="zapper">Zapper Light Gun</option>
                    </select>
                  </td>
                </tr> -->
                        <tr>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="160" height="15" border="0"></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table id="sb_roms" class="hidden">
                        <tr>
                            <td>ROM Type ID:</td>
                            <td>
                                <select name="romtype_op" style="width: 120px;">
                                    <option value="contains">Contains</option>
                                    <option value="starts">Starts w/</option>
                                    <option value="ends">Ends w/</option>
                                    <option value="not_like">Not Like</option>
                                    <option value="any">Any word</option>
                                    <option value="all">All words</option>
                                    <option value="exact">Exact match</option>
                                </select>
                            </td>
                            <td><input type="text" name="romtype" maxlength="32" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>Label:</td>
                            <td>
                                <select name="romname_op" style="width: 120px;">
                                    <option value="contains">Contains</option>
                                    <option value="starts">Starts w/</option>
                                    <option value="ends">Ends w/</option>
                                    <option value="not_like">Not Like</option>
                                    <option value="any">Any word</option>
                                    <option value="all">All words</option>
                                    <option value="exact">Exact match</option>
                                </select>
                            </td>
                            <td><input type="text" name="romname" maxlength="32" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>Size (KB):</td>
                            <td>
                                <select name="romsize_op" style="width: 120px;">
                                    <option value="equal">Equal to</option>
                                    <option value="not_equal">Not equal to</option>
                                    <option value="more_than">More than</option>
                                    <option value="less_than">Less than</option>
                                    <option value="more_than_equ">More than or equal</option>
                                    <option value="less_than_equ">Less than or equal</option>
                                </select>
                            </td>
                            <td><input type="text" name="romsize" maxlength="4" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>CRC-32 / SHA-1:</td>
                            <td>
                                <select name="romhash_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td><input type="text" name="romhash" maxlength="40" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>Times Verified (!):</td>
                            <td>
                                <select name="verified_op" style="width: 120px;">
                                    <option value="equal">Equal to</option>
                                    <option value="not_equal">Not equal to</option>
                                    <option value="more_than">More than</option>
                                    <option value="less_than">Less than</option>
                                    <option value="more_than_equ">More than or equal</option>
                                    <option value="less_than_equ">Less than or equal</option>
                                </select>
                            </td>
                            <td><input type="text" name="verified" maxlength="2" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="160" height="15" border="0"></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table id="sb_cart" class="hidden">
                        <tr>
                            <td>Submitter:</td>
                            <td>
                                <select name="sub_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td><input type="text" name="sub" maxlength="64" value="" onchange="field_changed(this.name)"></td>
                        </tr><!--
                <tr>
                  <td>Submission Date:</td>
                  <td>
                    <select name="subdate_op" style="width: 120px;">
                      <option value="on">On</option>
                      <option value="not_on">Not on</option>
                      <option value="after">After</option>
                      <option value="before">Before</option>
                      <option value="on_or_after">On or after</option>
                      <option value="on_or_before">On or before</option>
                    </select>
                  </td>
                  <td><input type="text" name="subdate" maxlength="10" value="" onchange="field_changed(this.name)"></td>
                </tr>-->
                        <tr>
                            <td>Version:</td>
                            <td>
                                <select name="version_op" style="width: 120px;">
                                    <option value="contains">Contains</option>
                                    <option value="starts">Starts w/</option>
                                    <option value="ends">Ends w/</option>
                                    <option value="not_like">Not Like</option>
                                    <option value="any">Any word</option>
                                    <option value="all">All words</option>
                                    <option value="exact">Exact match</option>
                                </select>
                            </td> <!-- style="width: 100px;" -->
                            <td><input type="text" name="version" maxlength="10" value="" onchange="field_changed(this.name)"><!-- <input type="checkbox" name="proto" value="1">Proto --></td>
                        </tr>
                        <tr>
                            <td>Cart Size (KB):</td>
                            <td>
                                <select name="cartsize_op" style="width: 120px;">
                                    <option value="equal">Equal to</option>
                                    <option value="not_equal">Not equal to</option>
                                    <option value="more_than">More than</option>
                                    <option value="less_than">Less than</option>
                                    <option value="more_than_equ">More than or equal</option>
                                    <option value="less_than_equ">Less than or equal</option>
                                </select>
                            </td>
                            <td><input type="text" name="cartsize" maxlength="4" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>CRC-32 / SHA-1:</td>
                            <td>
                                <select name="carthash_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td><input type="text" name="carthash" maxlength="40" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>Times Verified (!):</td>
                            <td>
                                <select name="cvc_op" style="width: 120px;">
                                    <option value="equal">Equal to</option>
                                    <option value="not_equal">Not equal to</option>
                                    <option value="more_than">More than</option>
                                    <option value="less_than">Less than</option>
                                    <option value="more_than_equ">More than or equal</option>
                                    <option value="less_than_equ">Less than or equal</option>
                                </select>
                            </td>
                            <td><input type="text" name="cvc" maxlength="2" value="" onchange="field_changed(this.name)"></td>
                        </tr><!--
                <tr>
                  <td>Scans:</td>
                  <td>
                    <select name="imagetype_op" style="width: 120px;">
                      <option value="have">Has</option>
                      <option value="not_have">Doesn't have</option>
                    </select>
                  </td>
                  <td>
                    <select name="imagetype" onchange="field_changed(this.name)">
                      <option value="">&lt;Any&gt;</option>
                      <option>Cart Front</option>
                      <option>Cart Back</option>
                      <option>Box Front</option>
                      <option>Box Back</option>
                      <option>Label</option>
                      <option>Insert</option>
                      <option>Manual</option>
                      <option>PCB Front</option>
                      <option>PCB Back</option>
                      <option>Cart Top</option>
                    </select>
                  </td>
                </tr>-->
                        <tr>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="160" height="15" border="0"></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table id="sb_pcb" class="hidden">
                        <tr>
                            <td>PCB Name:</td>
                            <td>
                                <select name="pcb_op" style="width: 120px;">
                                    <option value="contains">Contains</option>
                                    <option value="starts">Starts w/</option>
                                    <option value="ends">Ends w/</option>
                                    <option value="not_like">Not Like</option>
                                    <option value="any">Any word</option>
                                    <option value="all">All words</option>
                                    <option value="exact">Exact match</option>
                                </select>
                            </td>
                            <td><input type="text" name="pcb" maxlength="32" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>PCB Producer:</td>
                            <td>
                                <select name="pcbproducer_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td>
                                <select name="pcbproducer" onchange="field_changed(this.name)">
                                    <option value="">&lt;Any&gt;</option>
                                    <option>Acclaim</option>
                                    <option>Active</option>
                                    <option>AGCI</option>
                                    <option>AVE</option>
                                    <option>Bandai</option>
                                    <option>Code Masters</option>
                                    <option>Color Dreams</option>
                                    <option>Gradiente</option>
                                    <option>HES</option>
                                    <option>Irem</option>
                                    <option>Jaleco</option>
                                    <option>Konami</option>
                                    <option>Namcot</option>
                                    <option>Nintendo</option>
                                    <option>NTDEC</option>
                                    <option>Racer-Mate</option>
                                    <option>Sachen</option>
                                    <option>Seta</option>
                                    <option>Sunsoft</option>
                                    <option>Taito</option>
                                    <option>Tengen</option>
                                    <option>TXC</option>
                                    <option>Virgin Games</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>PCB Class:</td>
                            <td>
                                <select name="unif_op" style="width: 120px;">
                                    <option value="contains">Contains</option>
                                    <option value="starts">Starts w/</option>
                                    <option value="ends">Ends w/</option>
                                    <option value="not_like">Not Like</option>
                                    <option value="any">Any word</option>
                                    <option value="all">All words</option>
                                    <option value="exact">Exact match</option>
                                </select>
                            </td>
                            <td><input type="text" name="unif" maxlength="32" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>iNES Mapper:</td>
                            <td>
                                <select name="ines_op" style="width: 120px;">
                                    <option value="equal">Equal to</option>
                                    <option value="not_equal">Not equal to</option>
                                    <option value="more_than">More than</option>
                                    <option value="less_than">Less than</option>
                                    <option value="more_than_equ">More than or equal</option>
                                    <option value="less_than_equ">Less than or equal</option>
                                </select>
                            </td>
                            <td><input type="text" name="ines" maxlength="3" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>Battery-backed:</td>
                            <td>&nbsp;</td>
                            <td>
                                <select name="battery" onchange="field_changed(this.name)">
                                    <option value="">&lt;Any&gt;</option>
                                    <option>No</option>
                                    <option>Yes</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Mirroring:</td>
                            <td>
                                <select name="mirroring_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td>
                                <select name="mirroring" onchange="field_changed(this.name)">
                                    <option value="">&lt;Any&gt;</option>
                                    <option>Horizontal</option>
                                    <option>Vertical</option>
                                    <option>One Screen</option>
                                    <option>Four Screen</option>
                                    <option>Mapper Ctrl</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>CIC Type:</td>
                            <td>
                                <select name="cic_op" style="width: 120px;">
                                    <option value="equal">Equal</option>
                                    <option value="not_equal">Not Equal</option>
                                </select>
                            </td>
                            <td>
                                <select name="cic" onchange="field_changed(this.name)">
                                    <option value="">&lt;Any&gt;</option>
                                    <option>23C1033</option>
                                    <option>3193</option>
                                    <option>3193A</option>
                                    <option>3195</option>
                                    <option>3195A</option>
                                    <option>3197A</option>
                                    <option>337002</option>
                                    <option>337006</option>
                                    <option>4051</option>
                                    <option>6113</option>
                                    <option>6113A</option>
                                    <option>6113B1</option>
                                    <option>7660</option>
                                    <option>&lt;EPOXY&gt;</option>
                                    <option>CIC Stun</option>
                                    <option>KC5373B</option>
                                    <option>MX8018</option>
                                    <option>NINA</option>
                                    <option>None</option>
                                    <option>PIC16C54</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>CHR-RAM / VRAM (KB):</td>
                            <td>
                                <select name="vram_op" style="width: 120px;">
                                    <option value="equal">Equal to</option>
                                    <option value="not_equal">Not equal to</option>
                                    <option value="more_than">More than</option>
                                    <option value="less_than">Less than</option>
                                    <option value="more_than_equ">More than or equal</option>
                                    <option value="less_than_equ">Less than or equal</option>
                                </select>
                            </td>
                            <td><input type="text" name="vram" maxlength="3" value="" onchange="field_changed(this.name)"></td>
                        </tr>
                        <tr>
                            <td>PRG-RAM / WRAM (KB):</td>
                            <td>
                                <select name="wram_op" style="width: 120px;">
                                    <option value="equal">Equal to</option>
                                    <option value="not_equal">Not equal to</option>
                                    <option value="more_than">More than</option>
                                    <option value="less_than">Less than</option>
                                    <option value="more_than_equ">More than or equal</option>
                                    <option value="less_than_equ">Less than or equal</option>
                                </select>
                            </td>
                            <td><input type="text" name="wram" maxlength="3" value="" onchange="field_changed(this.name)"></td>
                        </tr><!--
                <tr valign="top">
                  <td>Hardware:</td>
                  <td>
                    <select name="hardware_op" style="width: 120px;">
                      <option value="any">Include Any</option>
                      <option value="all">Include All</option>
                      <option value="exclude">Exclude All</option>
                    </select>
                  </td>
                  <td>
                    <select name="hardware[]" multiple class="multi" onchange="field_changed(this.name)">
                      <option value="">&lt;Any&gt;</option>
                      <option>108</option>
                      <option>109</option>
                      <option>118</option>
                      <option>119</option>
                      <option>163</option>
                      <option>175</option>
                      <option>24C01</option>
                      <option>24C02</option>
                      <option>337001</option>
                      <option>337006</option>
                      <option>337007</option>
                      <option>340</option>
                      <option>4053</option>
                      <option>4520</option>
                      <option>74F04</option>
                      <option>74xx00</option>
                      <option>74xx02</option>
                      <option>74xx04</option>
                      <option>74xx08</option>
                      <option>74xx10</option>
                      <option>74xx123</option>
                      <option>74xx133</option>
                      <option>74xx138</option>
                      <option>74xx139</option>
                      <option>74xx153</option>
                      <option>74xx161</option>
                      <option>74xx163</option>
                      <option>74xx173</option>
                      <option>74xx174</option>
                      <option>74xx175</option>
                      <option>74xx20</option>
                      <option>74xx21</option>
                      <option>74xx245</option>
                      <option>74xx273</option>
                      <option>74xx30</option>
                      <option>74xx32</option>
                      <option>74xx377</option>
                      <option>74xx4040</option>
                      <option>74xx74</option>
                      <option>&lt;108&gt;</option>
                      <option>&lt;109&gt;</option>
                      <option>&lt;129&gt;</option>
                      <option>&lt;163&gt;</option>
                      <option>&lt;175&gt;</option>
                      <option>&lt;340&gt;</option>
                      <option>&lt;74xx00&gt;</option>
                      <option>&lt;74xx139&gt;</option>
                      <option>&lt;74xx161&gt;</option>
                      <option>&lt;74xx32&gt;</option>
                      <option>&lt;74xx74&gt;</option>
                      <option>&lt;MMC1&gt;</option>
                      <option>&lt;MMC3&gt;</option>
                      <option>&lt;SA8259A&gt;</option>
                      <option>&lt;Sunsoft-1&gt;</option>
                      <option>&lt;Sunsoft-3&gt;</option>
                      <option>&lt;VRC1&gt;</option>
                      <option>&lt;VRC2&gt;</option>
                      <option>BF9093</option>
                      <option>BF9096</option>
                      <option>BF9097</option>
                      <option>CCU_V2.00</option>
                      <option>CME-01</option>
                      <option>D7755C</option>
                      <option>D7756C</option>
                      <option>FCG-1</option>
                      <option>FCG-2</option>
                      <option>FCG-3</option>
                      <option>FME-7</option>
                      <option>G-101</option>
                      <option>GAL16V8S</option>
                      <option>Galoob 9203A</option>
                      <option>Galoob 9204S</option>
                      <option>IF-H3001</option>
                      <option>M50805</option>
                      <option>MC-ACC</option>
                      <option>MM1026</option>
                      <option>MMC1</option>
                      <option>MMC1A</option>
                      <option>MMC1B1</option>
                      <option>MMC1B1-H</option>
                      <option>MMC1B2</option>
                      <option>MMC1B3</option>
                      <option>MMC2</option>
                      <option>MMC2-L</option>
                      <option>MMC3A</option>
                      <option>MMC3B</option>
                      <option>MMC3C</option>
                      <option>MMC4</option>
                      <option>MMC5</option>
                      <option>MMC5A</option>
                      <option>MMC6B</option>
                      <option>NES-LD-0-EXP</option>
                      <option>PAL16L8</option>
                      <option>PAL16R4</option>
                      <option>PIC16C54</option>
                      <option>PT8154</option>
                      <option>RD387-001</option>
                      <option>SS88006</option>
                      <option>Sunsoft-1</option>
                      <option>Sunsoft-2</option>
                      <option>Sunsoft-3</option>
                      <option>Sunsoft-4</option>
                      <option>Sunsoft-5A</option>
                      <option>Sunsoft-5B</option>
                      <option>TAM-S1</option>
                      <option>TC-112</option>
                      <option>TC0190FMC</option>
                      <option>TC0350FMR</option>
                      <option>VRC1</option>
                      <option>VRC2</option>
                      <option>VRC3</option>
                      <option>VRC4</option>
                      <option>VRC6</option>
                      <option>VRC7</option>
                      <option>X1-005</option>
                      <option>X1-017</option>
                    </select>
                  </td>
                </tr> -->
                        <tr>
                            <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="160" height="15" border="0"></td>
                        </tr>
                    </table>
                </td>
                <!--            <td>
                              <table id="sb_chips" class="hidden">
                                <tr>
                                  <td>Part# / Suffix:</td>
                                  <td>
                                    <select name="partno_op" style="width: 120px;">
                                      <option value="contains">Contains</option>
                                      <option value="starts">Starts w/</option>
                                      <option value="ends">Ends w/</option>
                                      <option value="not_like">Not Like</option>
                                      <option value="any">Any word</option>
                                      <option value="all">All words</option>
                                      <option value="exact">Exact match</option>
                                    </select>
                                  </td>
                                  <td><input type="text" name="partno" maxlength="32" value="" style="width: 112px;" onchange="field_changed(this.name)"><input type="text" name="partsuffix" maxlength="16" value="" style="width: 40px;" onchange="field_changed(this.name)"></td>
                                </tr>
                                <tr>
                                  <td>Type:</td>
                                  <td>
                                    <select name="chiptype_op" style="width: 120px;">
                                      <option value="equal">Equal</option>
                                      <option value="not_equal">Not Equal</option>
                                    </select>
                                  </td>
                                  <td>
                                    <select name="chiptype" onchange="field_changed(this.name)">
                                      <option value="">&lt;Any&gt;</option>
                                      <option>4051</option>
                                      <option>4053</option>
                                      <option>4520</option>
                                      <option>74-00 Series</option>
                                      <option>74-02 Series</option>
                                      <option>74-04 Series</option>
                                      <option>74-08 Series</option>
                                      <option>74-10 Series</option>
                                      <option>74-123 Series</option>
                                      <option>74-133 Series</option>
                                      <option>74-138 Series</option>
                                      <option>74-139 Series</option>
                                      <option>74-153 Series</option>
                                      <option>74-161 Series</option>
                                      <option>74-163 Series</option>
                                      <option>74-173 Series</option>
                                      <option>74-174 Series</option>
                                      <option>74-175 Series</option>
                                      <option>74-20 Series</option>
                                      <option>74-21 Series</option>
                                      <option>74-245 Series</option>
                                      <option>74-273 Series</option>
                                      <option>74-30 Series</option>
                                      <option>74-32 Series</option>
                                      <option>74-377 Series</option>
                                      <option>74-4040 Series</option>
                                      <option>74-74 Series</option>
                                      <option>74F04</option>
                                      <option>7660 DC Charge Pump</option>
                                      <option>Acclaim MC-ACC</option>
                                      <option>ADPCM Speech Chip</option>
                                      <option>Aladdin MMC</option>
                                      <option>AVE CIC</option>
                                      <option>Bandai FCG-1</option>
                                      <option>Bandai FCG-2</option>
                                      <option>Bandai FCG-3</option>
                                      <option>Bonded ROM</option>
                                      <option>Camerica BF9093</option>
                                      <option>Camerica BF9096</option>
                                      <option>Camerica BF9097</option>
                                      <option>Chip-on-Board PCB</option>
                                      <option>Codemasters CME-01</option>
                                      <option>EXP Patch Chip</option>
                                      <option>GAL16</option>
                                      <option>Game Genie</option>
                                      <option>Irem G-101</option>
                                      <option>Irem H3001</option>
                                      <option>Irem TAM-S1</option>
                                      <option>Jaleco SS88006</option>
                                      <option>Konami VRC</option>
                                      <option>Konami VRC II</option>
                                      <option>Konami VRC III</option>
                                      <option>Konami VRC IV</option>
                                      <option>Konami VRC VI</option>
                                      <option>Konami VRC VII</option>
                                      <option>Mask ROM</option>
                                      <option>MM1026</option>
                                      <option>Namcot 108</option>
                                      <option>Namcot 109</option>
                                      <option>Namcot 118</option>
                                      <option>Namcot 119</option>
                                      <option>Namcot 129</option>
                                      <option>Namcot 163</option>
                                      <option>Namcot 175</option>
                                      <option>Namcot 340</option>
                                      <option>Nintendo CIC</option>
                                      <option>Nintendo MMC1</option>
                                      <option>Nintendo MMC2</option>
                                      <option>Nintendo MMC3</option>
                                      <option>Nintendo MMC4</option>
                                      <option>Nintendo MMC5</option>
                                      <option>Nintendo MMC6</option>
                                      <option>NTDEC CIC</option>
                                      <option>NTDEC TC-112</option>
                                      <option>PAL16</option>
                                      <option>PIC16C54</option>
                                      <option>PROM</option>
                                      <option>PT8154</option>
                                      <option>Serial EEPROM</option>
                                      <option>Sound Decoder/ROM</option>
                                      <option>SRAM</option>
                                      <option>Sunsoft FME-7</option>
                                      <option>Sunsoft-1</option>
                                      <option>Sunsoft-2</option>
                                      <option>Sunsoft-3</option>
                                      <option>Sunsoft-4</option>
                                      <option>Sunsoft-5</option>
                                      <option>Taito TC0190FMC</option>
                                      <option>Taito TC0350FMR</option>
                                      <option>Taito X1-005</option>
                                      <option>Taito X1-017</option>
                                      <option>Tengen CIC</option>
                                      <option>Tengen MIMIC-1</option>
                                      <option>Tengen RAMBO-1</option>
                                      <option>UV EPROM</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Size (KB or kb):</td>
                                  <td>
                                    <select name="chipsize_op" style="width: 120px;">
                                      <option value="equal">Equal to</option>
                                      <option value="not_equal">Not equal to</option>
                                      <option value="more_than">More than</option>
                                      <option value="less_than">Less than</option>
                                      <option value="more_than_equ">More than or equal</option>
                                      <option value="less_than_equ">Less than or equal</option>
                                    </select>
                                  </td>
                                  <td><input type="text" name="chipsize" maxlength="4" value="" onchange="field_changed(this.name)"></td>
                                </tr>
                                <tr>
                                  <td>Speed (ns):</td>
                                  <td>
                                    <select name="chipspeed_op" style="width: 120px;">
                                      <option value="equal">Equal to</option>
                                      <option value="not_equal">Not equal to</option>
                                      <option value="more_than">More than</option>
                                      <option value="less_than">Less than</option>
                                      <option value="more_than_equ">More than or equal</option>
                                      <option value="less_than_equ">Less than or equal</option>
                                    </select>
                                  </td>
                                  <td><input type="text" name="chipspeed" maxlength="3" value="" onchange="field_changed(this.name)"></td>
                                </tr>
                                <tr>
                                  <td>Maker:</td>
                                  <td>
                                    <select name="maker_op" style="width: 120px;">
                                      <option value="equal">Equal</option>
                                      <option value="not_equal">Not Equal</option>
                                    </select>
                                  </td>
                                  <td>
                                    <select name="maker" onchange="field_changed(this.name)">
                                      <option value="">&lt;Any&gt;</option>
                                      <option>Acclaim</option>
                                      <option>AMD</option>
                                      <option>AMI</option>
                                      <option>Code Masters</option>
                                      <option>Fairchild</option>
                                      <option>Fujitsu</option>
                                      <option>General Instrument</option>
                                      <option>GoldStar</option>
                                      <option>Harris</option>
                                      <option>Hitachi</option>
                                      <option>Hyundai</option>
                                      <option>IMP</option>
                                      <option>Inmos</option>
                                      <option>Intel</option>
                                      <option>JRC</option>
                                      <option>Konami</option>
                                      <option>Linear Tech</option>
                                      <option>LSI Logic</option>
                                      <option>Macronix</option>
                                      <option>Matsushita</option>
                                      <option>Maxim</option>
                                      <option>Microchip</option>
                                      <option>Mitel</option>
                                      <option>Mitsubishi</option>
                                      <option>Mitsumi</option>
                                      <option>Monolithic Memories</option>
                                      <option>MOSEL</option>
                                      <option>MOSEL - Vitelic</option>
                                      <option>Motorola</option>
                                      <option>National Semiconductor</option>
                                      <option>NCR</option>
                                      <option>NEC</option>
                                      <option>OKI</option>
                                      <option>Panasonic</option>
                                      <option>Phillips</option>
                                      <option>Ricoh</option>
                                      <option>Rohm</option>
                                      <option>Samsung</option>
                                      <option>Sanyo</option>
                                      <option>Seiko Instruments</option>
                                      <option>Seiko-Epson</option>
                                      <option>Semi Processes</option>
                                      <option>SGS</option>
                                      <option>Sharp</option>
                                      <option>Sigma</option>
                                      <option>Signetics</option>
                                      <option>Sony</option>
                                      <option>ST Micro</option>
                                      <option>Telcom</option>
                                      <option>Teledyne</option>
                                      <option>Texas Instruments</option>
                                      <option>Toshiba</option>
                                      <option>Victronix</option>
                                      <option>Vitelic</option>
                                      <option>VTI</option>
                                      <option>Winbond</option>
                                      <option>Xicor</option>
                                      <option>Yamaha</option>
                                      <option>Zytrex</option>
                                      <option>_UnkAMS</option>
                                      <option>_UnkMfg17</option>
                                      <option>_UnkMfg17-2</option>
                                      <option>_UnkRicohMexico</option>
                                      <option>__Unknown</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Package:</td>
                                  <td>
                                    <select name="package_op" style="width: 120px;">
                                      <option value="equal">Equal</option>
                                      <option value="not_equal">Not Equal</option>
                                    </select>
                                  </td>
                                  <td>
                                    <select name="package" onchange="field_changed(this.name)">
                                      <option value="">&lt;Any&gt;</option>
                                      <option>DIP</option>
                                      <option>EPOXY</option>
                                      <option>PCB</option>
                                      <option>PQFP</option>
                                      <option>SDIP</option>
                                      <option>SOP</option>
                                      <option>TQFP</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td># of Pins:</td>
                                  <td>
                                    <select name="pins_op" style="width: 120px;">
                                      <option value="equal">Equal to</option>
                                      <option value="not_equal">Not equal to</option>
                                      <option value="more_than">More than</option>
                                      <option value="less_than">Less than</option>
                                      <option value="more_than_equ">More than or equal</option>
                                      <option value="less_than_equ">Less than or equal</option>
                                    </select>
                                  </td>
                                  <td><input type="text" name="pins" maxlength="3" value="" onchange="field_changed(this.name)"></td>
                                </tr>
                                <tr>
                                  <td>DateCode:</td>
                                  <td>
                                    <select name="stdcode_op" style="width: 120px;">
                                      <option value="on">On</option>
                                      <option value="not_on">Not on</option>
                                      <option value="after">After</option>
                                      <option value="before">Before</option>
                                      <option value="on_or_after">On or after</option>
                                      <option value="on_or_before">On or before</option>
                                    </select>
                                  </td>
                                  <td><input type="text" name="stdcode" maxlength="4" value="" onchange="field_changed(this.name)"></td>
                                </tr>
                                <tr>
                                  <td><img src="{{ asset('images/spacer.gif') }}" alt="" width="160" height="15" border="0"></td>
                                </tr>
                              </table>
                            </td> -->
                <!--            <td>
                              <table id="sb_properties" class="hidden">
                                <tr>
                                  <td>Producer:</td>
                                  <td>
                                    <select name="producer_op" style="width: 120px;">
                                      <option value="equal">Equal</option>
                                      <option value="not_equal">Not Equal</option>
                                    </select>
                                  </td>
                                  <td>
                                    <select name="producer" id="producer" onchange="change_property_set()">
                                      <option value="">&lt;Any&gt;</option>
                                      <option>Acclaim</option>
                                      <option>Active</option>
                                      <option>AGCI</option>
                                      <option>AVE</option>
                                      <option>Bandai</option>
                                      <option>Caltron</option>
                                      <option>Camerica</option>
                                      <option>CCE</option>
                                      <option>Code Masters</option>
                                      <option>Color Dreams</option>
                                      <option>Galoob</option>
                                      <option>Gradiente</option>
                                      <option>HES</option>
                                      <option>Hi Tech Expressions</option>
                                      <option>Irem</option>
                                      <option>Jaleco</option>
                                      <option>Konami</option>
                                      <option>Micro Genius</option>
                                      <option>Namcot</option>
                                      <option>Nintendo (Famicom)</option>
                                      <option>Nintendo (NES)</option>
                                      <option>Nintendo / Sharp</option>
                                      <option>Panesian</option>
                                      <option>RacerMate</option>
                                      <option>Sachen</option>
                                      <option>SEI</option>
                                      <option>Seta</option>
                                      <option>Sunsoft</option>
                                      <option>Taito</option>
                                      <option>Tengen</option>
                                      <option>Virgin Games</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td>Color:</td>
                                  <td>
                                    <select name="color_op" style="width: 120px;">
                                      <option value="contains">Contains</option>
                                      <option value="starts">Starts w/</option>
                                      <option value="ends">Ends w/</option>
                                      <option value="not_like">Not Like</option>
                                      <option value="any">Any word</option>
                                      <option value="all">All words</option>
                                      <option value="exact">Exact match</option>
                                    </select>
                                  </td>
                                  <td><input type="text" name="color" maxlength="24" value="" onchange="field_changed(this.name)"></td>
                                </tr>
                                <tr>
                                  <td colspan="3">
                                    <table id="NintendoNES" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>3-Screw</option>
                                            <option>5-Screw</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Nintendo® Pat. Pend. Made in Japan</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="16" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Seal of Quality:</td>
                                        <td>
                                          <select name="p_prop3_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop3" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>None</option>
                                            <option>Oval (R)</option>
                                            <option>Oval (TM)</option>
                                            <option>PAL: Dual</option>
                                            <option>PAL: Round (Official)</option>
                                            <option>PAL: Round (Original)</option>
                                            <option>Round</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">MfgString Present:</td>
                                        <td>
                                          <select name="p_prop4_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop4" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>No</option>
                                            <option>Yes</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Back Label ID / Desc:</td>
                                        <td>
                                          <select name="p_prop5_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop5" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option selected></option>
                                            <option>CAN</option>
                                            <option>CAN (Battery)</option>
                                            <option>DAS</option>
                                            <option>DAS (Battery)</option>
                                            <option>EAI</option>
                                            <option>EAI (Battery)</option>
                                            <option>ESP</option>
                                            <option>FAH</option>
                                            <option>FAH (Battery)</option>
                                            <option>FAH-1</option>
                                            <option>FRA</option>
                                            <option>FRG</option>
                                            <option>Gold (Battery)</option>
                                            <option>Grey</option>
                                            <option>KOR</option>
                                            <option>NES-EAI-1</option>
                                            <option>NES-USA/CAN</option>
                                            <option>NES-USA/CAN (Battery)</option>
                                            <option>NES-USA/CAN-1</option>
                                            <option>NES-USA/CAN-1 (Battery)</option>
                                            <option>NES-ZL-FRG</option>
                                            <option>NES-ZL871104</option>
                                            <option>NES-ZL871104 &lt;P&gt;</option>
                                            <option>None</option>
                                            <option>PAL-ZL</option>
                                            <option>REV-A</option>
                                            <option>SCN</option>
                                            <option>SCN (Battery)</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">2-digit Code:</td>
                                        <td>
                                          <select name="p_prop6_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop6" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option selected></option>
                                            <option>00</option>
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                            <option>07</option>
                                            <option>08</option>
                                            <option>09</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>
                                            <option>19</option>
                                            <option>20</option>
                                            <option>21</option>
                                            <option>23</option>
                                            <option>24</option>
                                            <option>27</option>
                                            <option>28</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Revision:</td>
                                        <td>
                                          <select name="p_prop7_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop7" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option selected></option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>M</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="ColorDreams" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Inset Grip</option>
                                            <option>Protruding Grip</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Color Dreams, Inc. Pat. Pend. Made in Taiwan</option>
                                            <option>Manufacture by Color Dreams, Inc.</option>
                                            <option>Manufactured by Color Dreams, Inc.</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Back Label Desc:</td>
                                        <td>
                                          <select name="p_prop5_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop5" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Black Caution Label</option>
                                            <option>Blue Caution Label</option>
                                            <option>Blue Contest Label</option>
                                            <option>Embossed Label</option>
                                            <option>Grey Caution Label</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="Tengen" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Original</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Back Label Desc:</td>
                                        <td>
                                          <select name="p_prop5_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop5" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>w/ Mfg by Tengen</option>
                                            <option>w/o Mfg by Tengen</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">4-digit Code:</td>
                                        <td>
                                          <select name="p_prop6_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop6" maxlength="4" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="Acclaim" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>3-Screw</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Manufactured by Acclaim Licensed by Nintendo Made in U.S.A.</option>
                                            <option>Manufactured by Hi Tech Expressions Licensed by Nintendo Made in U.S.A.</option>
                                            <option>Manufactured by Virgin Games Licensed by Nintendo Made in U.S.A.</option>
                                            <option>Nintendo® Pat. Pend. Made in Japan</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="10" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Seal of Quality:</td>
                                        <td>
                                          <select name="p_prop3_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop3" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Oval (R)</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">MfgString Present:</td>
                                        <td>
                                          <select name="p_prop4_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop4" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Yes</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Back Label ID:</td>
                                        <td>
                                          <select name="p_prop5_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop5" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>REV-A</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">4-digit Code:</td>
                                        <td>
                                          <select name="p_prop6_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop6" maxlength="4" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="Camerica" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Aladdin Cart</option>
                                            <option>NES Cart</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Made in Taiwan Design Patent Pending</option>
                                            <option>U.S. &amp; Canadian design applications pending. Made in the U.K.</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="AVE" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Cut Corner</option>
                                            <option>Square Corner</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>American Video Entertainment Made in USA</option>
                                            <option>None</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Back Label Desc:</td>
                                        <td>
                                          <select name="p_prop5_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop5" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>English &amp; French Caution Label</option>
                                            <option>English Caution Label</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="SEI" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Original</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>S.E.I. Made in USA</option>
                                            <option>S.E.I. Made in USA Pat. Pending</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label Desc:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop2" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Black &amp; White Label</option>
                                            <option>Color Label</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="AGCI" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Deep Grip</option>
                                            <option>Shallow Grip</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>AGCI Patent Pending</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="6" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="Galoob" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Game Genie</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="VirginGames" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>3-Screw</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Manufactured by Acclaim Licensed by Nintendo Made in U.S.A.</option>
                                            <option>Manufactured by Hi Tech Expressions Licensed by Nintendo Made in U.S.A.</option>
                                            <option>Manufactured by Virgin Games Licensed by Nintendo Made in U.S.A.</option>
                                            <option>Nintendo® Pat. Pend. Made in Japan</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="10" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Seal of Quality:</td>
                                        <td>
                                          <select name="p_prop3_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop3" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Oval (R)</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">MfgString Present:</td>
                                        <td>
                                          <select name="p_prop4_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop4" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Yes</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Back Label ID:</td>
                                        <td>
                                          <select name="p_prop5_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop5" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>REV-A</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">4-digit Code:</td>
                                        <td>
                                          <select name="p_prop6_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop6" maxlength="4" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="HiTechExpressions" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>3-Screw</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Manufactured by Acclaim Licensed by Nintendo Made in U.S.A.</option>
                                            <option>Manufactured by Hi Tech Expressions Licensed by Nintendo Made in U.S.A.</option>
                                            <option>Manufactured by Virgin Games Licensed by Nintendo Made in U.S.A.</option>
                                            <option>Nintendo® Pat. Pend. Made in Japan</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="10" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Seal of Quality:</td>
                                        <td>
                                          <select name="p_prop3_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop3" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Oval (R)</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">MfgString Present:</td>
                                        <td>
                                          <select name="p_prop4_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop4" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Yes</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Back Label ID:</td>
                                        <td>
                                          <select name="p_prop5_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop5" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>REV-A</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">4-digit Code:</td>
                                        <td>
                                          <select name="p_prop6_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop6" maxlength="4" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="Sachen" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Original</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="Active" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Original</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Active Enterprises, LTD. U.S. Pat. Pend. Made in U.S.A.</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label Desc:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop2" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Clear Label</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="HES" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Pass-Thru</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="NintendoFamicom" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Family Basic</option>
                                            <option>HVC-023 RAM Adapter</option>
                                            <option>Large w/ Famicom Logo</option>
                                            <option>Large w/ Nintendo Logo</option>
                                            <option>Small</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="16" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Secondary ID:</td>
                                        <td>
                                          <select name="p_prop3_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop3" maxlength="16" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Back Label ID / Desc:</td>
                                        <td>
                                          <select name="p_prop5_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop5" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option selected></option>
                                            <option>830404</option>
                                            <option>830901</option>
                                            <option>831018</option>
                                            <option>840315</option>
                                            <option>850610</option>
                                            <option>851224</option>
                                            <option>860410</option>
                                            <option>870417</option>
                                            <option>870921</option>
                                            <option>880304</option>
                                            <option>880606</option>
                                            <option>880920 (Black Text)</option>
                                            <option>880920 (Blue Text)</option>
                                            <option>880920 (Red Text)</option>
                                            <option>Black Text</option>
                                            <option>DFC-BW</option>
                                            <option>EFC-D3</option>
                                            <option>EFC-D4</option>
                                            <option>ESF-TO</option>
                                            <option>Green Text</option>
                                            <option>NBF-01</option>
                                            <option>NBF-02</option>
                                            <option>NBF-03</option>
                                            <option>NBF-04</option>
                                            <option>NBF-05</option>
                                            <option>NBF-KH</option>
                                            <option>NBF-R7</option>
                                            <option>SHI-OB</option>
                                            <option>SHI-OK</option>
                                            <option>SHI-OS</option>
                                            <option>SHI-RN</option>
                                            <option>SHI-UU</option>
                                            <option>TKS</option>
                                            <option>VAP-BG</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">2-digit Code:</td>
                                        <td>
                                          <select name="p_prop6_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop6" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option selected></option>
                                            <option>00</option>
                                            <option>01</option>
                                            <option>02</option>
                                            <option>04</option>
                                            <option>05</option>
                                            <option>08</option>
                                            <option>09</option>
                                            <option>11</option>
                                            <option>112</option>
                                            <option>12</option>
                                            <option>17</option>
                                            <option>17²</option>
                                            <option>17¹</option>
                                            <option>19</option>
                                            <option>21</option>
                                            <option>33</option>
                                            <option>34</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Revision:</td>
                                        <td>
                                          <select name="p_prop7_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop7" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option selected></option>
                                            <option>A</option>
                                            <option>A1</option>
                                            <option>B</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="Caltron" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Original</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="5" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="NintendoSharp" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Family Basic</option>
                                            <option>HVC-023 RAM Adapter</option>
                                            <option>Large w/ Famicom Logo</option>
                                            <option>Large w/ Nintendo Logo</option>
                                            <option>Small</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="16" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Secondary ID:</td>
                                        <td>
                                          <select name="p_prop3_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop3" maxlength="16" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Back Label ID / Desc:</td>
                                        <td>
                                          <select name="p_prop5_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop5" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option selected></option>
                                            <option>830404</option>
                                            <option>830901</option>
                                            <option>831018</option>
                                            <option>840315</option>
                                            <option>850610</option>
                                            <option>851224</option>
                                            <option>860410</option>
                                            <option>870417</option>
                                            <option>870921</option>
                                            <option>880304</option>
                                            <option>880606</option>
                                            <option>880920 (Black Text)</option>
                                            <option>880920 (Blue Text)</option>
                                            <option>880920 (Red Text)</option>
                                            <option>Black Text</option>
                                            <option>DFC-BW</option>
                                            <option>EFC-D3</option>
                                            <option>EFC-D4</option>
                                            <option>ESF-TO</option>
                                            <option>Green Text</option>
                                            <option>NBF-01</option>
                                            <option>NBF-02</option>
                                            <option>NBF-03</option>
                                            <option>NBF-04</option>
                                            <option>NBF-05</option>
                                            <option>NBF-KH</option>
                                            <option>NBF-R7</option>
                                            <option>SHI-OB</option>
                                            <option>SHI-OK</option>
                                            <option>SHI-OS</option>
                                            <option>SHI-RN</option>
                                            <option>SHI-UU</option>
                                            <option>TKS</option>
                                            <option>VAP-BG</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">2-digit Code:</td>
                                        <td>
                                          <select name="p_prop6_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop6" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option selected></option>
                                            <option>00</option>
                                            <option>01</option>
                                            <option>02</option>
                                            <option>04</option>
                                            <option>05</option>
                                            <option>08</option>
                                            <option>09</option>
                                            <option>11</option>
                                            <option>112</option>
                                            <option>12</option>
                                            <option>17</option>
                                            <option>17²</option>
                                            <option>17¹</option>
                                            <option>19</option>
                                            <option>21</option>
                                            <option>33</option>
                                            <option>34</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Revision:</td>
                                        <td>
                                          <select name="p_prop7_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop7" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option selected></option>
                                            <option>A</option>
                                            <option>A1</option>
                                            <option>B</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="Bandai" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Large</option>
                                            <option>Small</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Bandai 19xx Made in Japan</option>
                                            <option>© Bandai 19xx Made in Japan</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="Irem" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>New Style</option>
                                            <option>Original w/ LED</option>
                                            <option>Original wo/ LED</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="5" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="Sunsoft" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Dual Cassette</option>
                                            <option>Small</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Made in Japan</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="Jaleco" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Large</option>
                                            <option>Small</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Made in Japan</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="5" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="Taito" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Beveled Label / Logo 3</option>
                                            <option>Short Label / Logo 1 / 2 Screws</option>
                                            <option>Short Label / Logo 1 / 3 Screws</option>
                                            <option>Short Label / Logo 2 / 2 Screws</option>
                                            <option>Short Label / Logo 2 / 3 Screws</option>
                                            <option>Tall Label / Logo 1 / Fake Battery Door</option>
                                            <option>Tall Label / Logo 1 / No Battery Door</option>
                                            <option>Tall Label / Logo 1 / Real Battery Door</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Back Label ID / Desc:</td>
                                        <td>
                                          <select name="p_prop5_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop5" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option selected></option>
                                            <option>G1000777A</option>
                                            <option>G1000785A</option>
                                            <option>G7000002A</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="24" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Sequence #:</td>
                                        <td>
                                          <select name="p_prop3_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop3" maxlength="2" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Secondary ID:</td>
                                        <td>
                                          <select name="p_prop4_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop4" maxlength="10" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="Konami" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Large</option>
                                            <option>Small</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="8" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="Namcot" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Large</option>
                                            <option>Small</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="2" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="Panesian" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Original</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="Seta" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Original</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="16" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="RacerMate" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Original</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                    <table id="MicroGenius" class="noprops">
                                      <tr>
                                        <td width="100%">Front Label ID:</td>
                                        <td>
                                          <select name="p_prop2_op" style="width: 120px;">
                                            <option value="contains">Contains</option>
                                            <option value="starts">Starts w/</option>
                                            <option value="ends">Ends w/</option>
                                            <option value="not_like">Not Like</option>
                                            <option value="any">Any word</option>
                                            <option value="all">All words</option>
                                            <option value="exact">Exact match</option>
                                          </select>
                                        </td>
                                        <td><input type="text" name="p_prop2" maxlength="7" value="" onchange="field_changed(this.name)"></td>
                                      </tr>
                                    </table>
                                    <table id="Gradiente" class="noprops"></table>
                                    <table id="CCE" class="noprops"></table>
                                    <table id="CodeMasters" class="noprops">
                                      <tr>
                                        <td width="100%">Form Factor:</td>
                                        <td>
                                          <select name="p_FormFactor_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_FormFactor" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>NES Cart</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100%">Embossed Text:</td>
                                        <td>
                                          <select name="p_prop1_op" style="width: 120px;">
                                            <option value="equal">Equal</option>
                                            <option value="not_equal">Not Equal</option>
                                          </select>
                                        </td>
                                        <td>
                                          <select name="p_prop1" onchange="field_changed(this.name)">
                                            <option value="">&lt;Any&gt;</option>
                                            <option>Copyright Codemasters Software Company Limited 1992 Registered Design Pending</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                                <tr>
                                  <td><img src="/img/spacer.gif" alt="" width="160" height="1" border="0"></td>
                                </tr>
                              </table>
                            </td> -->
                <td width="100%">
                    &nbsp;
                </td>
                <td>
                    <table width="435"><!--
                <tr>
                  <td colspan="2">
                    <table>
                      <tr>
                        <th>Available Fields</th>
                        <td>&nbsp;</td>
                        <th>Selected Fields</th>
                      </tr>
                      <tr>
                        <td id="test" rowspan="3" valign="top">
                          <select id="fieldref" multiple class="fields" style="display: none">
                            <optgroup label="General Info">
                              <option value="1">Region</option>
                              <option value="2">Game Title</option>
                              <option value="3">Catalog ID</option>
                              <option value="11">Publisher</option>
                              <option value="12">Developer</option>
                              <option value="13">Port Developer</option>
                              <option value="6">Release Date</option>
                              <option value="7">Class</option>
                              <option value="14">System</option>
                              <option value="5"># of Players</option>
                              <option value="4">Peripherals</option>
                            </optgroup>
                            <optgroup label="Hardware Info">
                              <option value="9">PCB Name</option>
                              <option value="8">PCB Class</option>
                              <option value="10">iNES Mapper</option>
                              <option value="15">Mirroring</option>
                              <option value="16">Battery</option>
                              <option value="18">VRAM</option>
                              <option value="19">WRAM</option>
                              <option value="17">CIC Type</option>
                              <option value="56">PCB Producer</option>
                              <option value="37">Hardware</option>
                            </optgroup>
                            <optgroup label="Cartridge Info">
                              <option value="20">Submitter</option>
                              <option value="23">Cart CRC32</option>
                              <option value="24">Cart SHA-1</option>
                              <option value="32">Cart Size</option>
                              <option value="41">Submission Date</option>
                              <option value="53">Cart Verified #</option>
                            </optgroup>
                            <optgroup label="Rom Info">
                              <option value="54">ROM Type</option>
                              <option value="22">ROM Label</option>
                              <option value="26">ROM Size</option>
                              <option value="28">ROM CRC32</option>
                              <option value="30">ROM SHA-1</option>
                              <option value="55">ROM Verified #</option>
                            </optgroup>
                            <optgroup label="Images">
                              <option value="21">Cart Top</option>
                              <option value="51">Cart Front</option>
                              <option value="52">PCB Front</option>
                            </optgroup>
                            <optgroup label="Chip Info">
                              <option value="36">Designation</option>
                              <option value="34">Chip Maker</option>
                              <option value="33">Part #</option>
                              <option value="35">Chip Type</option>
                              <option value="38">Package</option>
                              <option value="40">DateCode</option>
                              <option value="43">Speed</option>
                            </optgroup>
                            <optgroup label="Properties">
                              <option value="45">Cart Producer</option>
                              <option value="44">Color</option>
                              <option value="46">Back Label Code</option>
                              <option value="47">Back Label ID / Desc</option>
                              <option value="48">Hardware Revision</option>
                              <option value="49">Front Label ID / Desc</option>
                              <option value="50">Form Factor</option>
                            </optgroup>
                          </select>
                          <select id="fieldselect" name="select_fields[]" multiple class="fields">
                            <optgroup label="General Info">
                              <option value="12">Developer</option>
                              <option value="13">Port Developer</option>
                              <option value="6">Release Date</option>
                              <option value="7">Class</option>
                              <option value="14">System</option>
                              <option value="5"># of Players</option>
                              <option value="4">Peripherals</option>
                            </optgroup>
                            <optgroup label="Hardware Info">
                              <option value="8">PCB Class</option>
                              <option value="10">iNES Mapper</option>
                              <option value="15">Mirroring</option>
                              <option value="16">Battery</option>
                              <option value="18">VRAM</option>
                              <option value="19">WRAM</option>
                              <option value="17">CIC Type</option>
                              <option value="56">PCB Producer</option>
                              <option value="37">Hardware</option>
                            </optgroup>
                            <optgroup label="Cartridge Info">
                              <option value="23">Cart CRC32</option>
                              <option value="24">Cart SHA-1</option>
                              <option value="32">Cart Size</option>
                            </optgroup>
                            <optgroup label="Rom Info">
                              <option value="54">ROM Type</option>
                              <option value="22">ROM Label</option>
                              <option value="26">ROM Size</option>
                              <option value="28">ROM CRC32</option>
                              <option value="30">ROM SHA-1</option>
                              <option value="55">ROM Verified #</option>
                            </optgroup>
                            <optgroup label="Images">
                              <option value="21">Cart Top</option>
                              <option value="51">Cart Front</option>
                              <option value="52">PCB Front</option>
                            </optgroup>
                            <optgroup label="Chip Info">
                              <option value="36">Designation</option>
                              <option value="34">Chip Maker</option>
                              <option value="33">Part #</option>
                              <option value="35">Chip Type</option>
                              <option value="38">Package</option>
                              <option value="40">DateCode</option>
                              <option value="43">Speed</option>
                            </optgroup>
                            <optgroup label="Properties">
                              <option value="45">Cart Producer</option>
                              <option value="44">Color</option>
                              <option value="46">Back Label Code</option>
                              <option value="47">Back Label ID / Desc</option>
                              <option value="48">Hardware Revision</option>
                              <option value="49">Front Label ID / Desc</option>
                              <option value="50">Form Factor</option>
                            </optgroup>
                          </select>
                        </td>
                        <td align="center">
                          <input style="width: 60px" type="button" onclick="clearOption()" value="« Clear «">
                          <input style="width: 60px" type="button" onclick="addOption()" value="« Rem">
                          <input style="width: 60px" type="button" onclick="removeOption()" value="Add »">
                          <input style="width: 60px" type="button" onclick="moveUp()" value="Up">
                          <input style="width: 60px" type="button" onclick="moveDown()" value="Down">
                          <input style="width: 60px" type="button" onclick="defaultFields()" value="Default »">
                        </td>
                        <td valign="top">
                          <select id="fieldorder" multiple class="fields" name="result_fields[]" style="height: 140px">
                            <option value="1">Region</option>
                            <option value="2">Game Title</option>
                            <option value="11">Publisher</option>
                            <option value="3">Catalog ID</option>
                            <option value="9">PCB Name</option>
                            <option value="20">Submitter</option>
                            <option value="41">Submission Date</option>
                            <option value="53">Cart Verified #</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td nowrap>
                          <input type="text" id="savename" maxlength="24" style="width: 111px" value="">
                          <input style="width: 60px" type="button" onclick="saveResultFields()" value="Save">
                        </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td nowrap>
                          <select id="templates" style="width: 115px">
                            <option></option>
                          </select>
                          <input style="width: 60px" type="button" onclick="loadResultFields()" value="Load">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>-->
                        <tr>
                            <td>
                                Group by:
                            </td>
                            <td>
                                <select name="group">
                                    <option value="infoid">1 game listing per region</option>
                                    <!-- <option value="groupid">1 game listing for all regions</option> -->
                                    <option value="cartid">Don't remove any listings</option>
                                </select>
                            </td>
                        </tr>
                        <!-- <tr>
                          <td width="175">
                            Sort By:
                          </td>
                          <td width="260">
                            <select id="sortfield" name="field">
                              <option value="1">Region</option>
                              <option selected value="2">Game Title</option>
                              <option value="11">Publisher</option>
                              <option value="3">Catalog ID</option>
                              <option value="9">PCB Name</option>
                              <option value="20">Submitter</option>
                              <option value="41">Submission Date</option>
                              <option value="53">Cart Verified #</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Sort Order:
                          </td>
                          <td class="textsmall">
                            <input checked type="radio" name="order" value="asc">									Ascending&nbsp;
                            <input type="radio" name="order" value="desc">									Descending&nbsp;
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Results per Page:
                          </td>
                          <td>
                            <select name="rows" style="width: 60px">
                              <option>25</option>
                              <option>50</option>
                              <option>100</option>
                              <option>200</option>
                              <option>400</option>
                            </select>
                            <input type="hidden" id="rfa" name="rfa" maxlength="128" value="">
                            <input type="submit" value="Search" onclick="document.frmASearch.action = '/search/advanced'">
                          </td>
                        </tr> -->
                        <tr><td><input type="submit" value="Search" onclick="document.frmASearch.action = '/search/advanced'" style="width: 100px; height: 40px; font-size: 14px;"></td></tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
    <img onload="advancedPageInit('')" src="{{ asset('images/spacer.gif') }}" alt="">
@endsection
