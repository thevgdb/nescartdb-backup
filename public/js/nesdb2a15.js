function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) c_end = document.cookie.length;
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

function setCookie(c_name, value, expiredays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + expiredays);
    document.cookie = c_name + "=" + escape(value) + ((expiredays == 0) ? "" : ";expires=" + exdate.toGMTString()) + ";path=/";
}

function detectBrowser() {
    if (getCookie('warned') == 1)
        return;
    var browser = navigator.appName;
    var b_version = navigator.appVersion;
    if (browser == "Microsoft Internet Explorer")
        alert("This site currently has some rendering issues with Internet Explorer. If you have FireFox, use it!");

    setCookie('warned', 1, 0);
}


function popup(mylink, windowname) {
    if (!window.focus)
        return true;
    var href;
    if (typeof(mylink) == 'string')
        href = mylink;
    else
        href = mylink.href;
    window.open(href, windowname, 'width=400,height=250,scrollbars=yes');
    return false;
}


function saveResultFields() {
    var name = document.getElementById("savename");
    if (name.value == "") {
        alert("Please enter a name for your save result template");
        return;
    }
    var savename = "srf_" + name.value;
    var x = document.getElementById("fieldorder");
    if (x.length == 0) {
        alert("You must specify at least 1 result field!");
        return false;
    }

    var arr = "";
    for (var i = 0; i < x.length; i++) {
        arr += x.options[i].value;
        if (i != x.length - 1) {
            arr += ",";
        }
    }

    setCookie(savename, arr, 365);
    alert("Template saved in cookie named: " + savename);


}

function loadResultFields() {
    var name = document.getElementById("templates");
    if (name[name.selectedIndex].text == "") {
        alert("You haven't saved any templates!");
        return;
    }

    var loadname = "srf_" + name[name.selectedIndex].text;

    clearOption();

    var x = document.getElementById("fieldorder");
    var y = document.getElementById("fieldselect");
    var cook = getCookie(loadname);
    var arr = cook.split(",");
    //alert(cook);


    for (var i = 0; i < arr.length; i++) {
        var n = document.createElement("option");
        n.value = arr[i];
        for (var j = 0; j < y.length; j++) {
            if (y.options[j].value == n.value) {
                n.text = y.options[j].text;
                try {
                    x.add(n, null);
                } catch (ex) {
                    x.add(n);
                }
                y.remove(j);
                break;
            }
        }
    }
}

function defaultFields() {
    clearOption();

    var x = document.getElementById("fieldorder");
    var y = document.getElementById("fieldselect");
    var s = document.getElementById("sortfield");

    arr = new Array(1, 2, 11, 3, 9, 20, 41, 53);
    for (var i = 0; i < arr.length; i++) {
        var n1 = document.createElement("option");
        var n2 = document.createElement("option");
        n1.value = arr[i];
        n2.value = arr[i];
        for (var j = 0; j < y.length; j++) {
            if (y.options[j].value == n1.value) {
                n1.text = y.options[j].text;
                n2.text = y.options[j].text;
                try {
                    x.add(n1, null);
                    s.add(n2, null);
                } catch (ex) {
                    x.add(n1);
                    s.add(n2);
                }
                y.remove(j);
                break;
            }
        }
    }
}

function clearOption() {
    var x = document.getElementById("fieldorder");
    var y = document.getElementById("fieldselect");
    var z = document.getElementById("fieldref");
    var d = document.getElementById("test");
    var s = document.getElementById("sortfield");


    len = x.length;
    for (i = 0; i < len; i++)
        x.remove(0);

    len = s.length;
    for (i = 0; i < len; i++)
        s.remove(0);

    var cpy = z.cloneNode(true);
    cpy.style.display = "inline";
    cpy.style.width = "180px";
    cpy.id = "fieldselect";
    cpy.name = "select_fields[]";
    d.replaceChild(cpy, y);

}

function swap_cart_pic() {
    var b = document.getElementById("cartpicbutton");

    if (b.name == "cartback") {
        document.getElementById("cartback").style.display = "";
        document.getElementById("cartfront").style.display = "none";
        b.name = "cartfront";
    } else {
        document.getElementById("cartback").style.display = "none";
        document.getElementById("cartfront").style.display = "";
        b.name = "cartback";
    }
}

function disableChildNodes(node, v) {
    node.disabled = v;
    for (var i = 0; i < node.childNodes.length; i++) {
        if (node.childNodes[i].nodeName == '#text')
            continue;
        node.childNodes[i].disabled = v;
        if (node.childNodes[i].childNodes.length > 0)
            disableChildNodes(node.childNodes[i], v);
    }
}

function field_changed(name) {
    var n = document.getElementsByName(name);
    if (!n) return;

    if (n[0].type == 'text') {
        if (n[0].value == '')
            mod = false;
        else
            mod = true;
    } else {
        if (n[0].selectedIndex < 1)
            mod = false;
        else
            mod = true;
    }

    if (!mod)
        n[0].style.backgroundColor = "White";
    else
        n[0].style.backgroundColor = "LightBlue";

    if (!mod) {
        var f = document.forms[1];
        for (var i = 0; i < f.length; i++) {
            if (f.elements[i].style.backgroundColor == "LightBlue") {
                mod = true;
                break;
            }
        }
    }

    n = document.getElementById('modind');
    if (mod)
        n.className = 'mod';
    else
        n.className = 'notmod';
}

function display_all_rows(show) {
    var rows = document.getElementById("srtbl").rows;

    var i = document.getElementById("img_parent");
    if (!i) return;

    if (show == true) {
        i.src = "/images/minus.gif";
        i.alt = "Contract All";
        i.onclick = function() {
            display_all_rows(false);
        }
    } else {
        i.src = "/images/plus.gif";
        i.alt = "Expand All";
        i.onclick = function() {
            display_all_rows(true);
        }
    }

    for (var i = 0; i < rows.length; i++) {
        var cartid = rows[i].id;
        if (cartid.match("_") || cartid == "")
            continue;
        display_rows("_" + cartid, show, "srtbl");
    }
}

function display_rows(cartid, show, tableid) {
    var rows = document.getElementById(tableid).rows;

    var i = document.getElementById("img" + cartid);
    if (!i) return;

    if (show == true) {
        i.src = "/images/minus.gif";
        i.alt = "Contract";
        i.onclick = function() {
            display_rows(cartid, false, tableid);
        }
    } else {
        i.src = "/images/plus.gif";
        i.alt = "Expand";
        i.onclick = function() {
            display_rows(cartid, true, tableid);
        }
    }

    for (var i = 0; i < rows.length; i++) {
        if (rows[i].id == cartid) {
            if (show == true)
                rows[i].style.display = ""; //was table-row but IE doesn't like that
            else
                rows[i].style.display = "none";
        }
    }
}

function search_box(name) {
    if (name == "")
        name = 'game';

    // var boxes = new Array('game','roms','cart','pcb','chips','properties');
    var boxes = new Array('game','roms','cart','pcb');

    for (i = 0; i < boxes.length; i++) {
        var boxname = 'sb_' + boxes[i];
        var tabname = 'tab_' + boxes[i];
        if (boxname != 'sb_' + name) {
            document.getElementById(boxname).className = "hidden";
            document.getElementById(tabname).className = "tab";
        } else {
            document.getElementById(boxname).className = "show";
            document.getElementById(tabname).className = "tabsel";
            setCookie('last_search_tab', name, 0);
        }
    }
}

function display_box(name, show) {
    if (name == "") {
        disable_props();
        return;
    }

    var enc = name.replace(' ', '');
    enc = enc.replace(' ', '');
    enc = enc.replace('(', '');
    enc = enc.replace(')', '');
    enc = enc.replace('/', '');

    var a = document.getElementById(enc);
    if (a == null)
        return;
    if (show == true) {
        disableChildNodes(a, false);
        a.className = "props";
        //a.style.display = "";
    } else {
        disableChildNodes(a, true);
        a.className = "noprops";
        //a.style.display = "none";
    }
}

function disable_props() {
    var f = document.forms[1];
    for (var i = 0; i < f.length; i++) {
        var e = f.elements[i].name;
        if (e.match("p_") != null)
            f.elements[i].disabled = true;
    }
}

function change_property_set() {
    var a = document.getElementById("producer");

    for (i = 0; i < a.length; i++) {
        if (i == a.selectedIndex)
            display_box(a.options[i].text, true);
        else
            display_box(a.options[i].text, false);
    }

    field_changed('producer');
}

function removeOption() {
    var x = document.getElementById("fieldselect");
    if (x.selectedIndex == -1)
        return;
    var y = document.getElementById("fieldorder");
    var z = document.getElementById("sortfield");

    for (i = 0; i < x.options.length; i++) {
        if (!x.options[i].selected)
            continue;

        var n = document.createElement("option");
        n.text = x.options[i].text;
        n.value = x.options[i].value;
        try {
            y.add(n, null);
        } catch (ex) {
            y.add(n);
        }
        n = document.createElement("option");
        n.text = x.options[i].text;
        n.value = x.options[i].value;
        try {
            z.add(n, null);
        } catch (ex) {
            z.add(n);
        }
    }
    for (i = x.options.length - 1; i >= 0; i--) {
        if (x.options[i].selected)
            x.remove(i);
    }

}

function addOption() {
    var y = document.getElementById("fieldselect");
    var x = document.getElementById("fieldorder");
    if (x.selectedIndex == -1)
        return;
    var z = document.getElementById("sortfield");

    for (i = 0; i < x.options.length; i++) {
        if (!x.options[i].selected)
            continue;

        var n = document.createElement("option");
        n.text = x.options[i].text;
        n.value = x.options[i].value;
        try {
            y.add(n, null);
        } catch (ex) {
            y.add(n);
        }

        for (j = 0; j < z.length; j++) {
            if (z.options[j].value == n.value)
                z.remove(j);
        }
    }

    for (i = x.options.length - 1; i >= 0; i--) {
        if (x.options[i].selected)
            x.remove(i);
    }
}

function moveUp() {
    var x = document.getElementById("fieldorder");
    if (x.selectedIndex == -1)
        return;
    var txt1 = x.options[x.selectedIndex].text;
    var val1 = x.options[x.selectedIndex].value;
    var txt2 = x.options[x.selectedIndex - 1].text;
    var val2 = x.options[x.selectedIndex - 1].value;
    x.options[x.selectedIndex].text = txt2;
    x.options[x.selectedIndex].value = val2;
    x.options[x.selectedIndex - 1].text = txt1;
    x.options[x.selectedIndex - 1].value = val1;
    x.selectedIndex -= 1;
}

function moveDown() {
    var x = document.getElementById("fieldorder");
    if (x.selectedIndex == -1)
        return;
    var txt1 = x.options[x.selectedIndex].text;
    var val1 = x.options[x.selectedIndex].value;
    var txt2 = x.options[x.selectedIndex + 1].text;
    var val2 = x.options[x.selectedIndex + 1].value;
    x.options[x.selectedIndex].text = txt2;
    x.options[x.selectedIndex].value = val2;
    x.options[x.selectedIndex + 1].text = txt1;
    x.options[x.selectedIndex + 1].value = val1;
    x.selectedIndex += 1;
}

function advancedPageInit(tab) {
    change_property_set();
    search_box(tab);
}

function selectAllFields() {
/*    var x = document.getElementById("fieldorder");
    if (x.length == 0) {
        alert("You must specify at least 1 result field!");
        return false;
    }

    var arr = new Array;
    var rfa = '';
    for (var i = 0; i < x.length; i++) {
        arr[i] = x.options[i].value;
        rfa += arr[i];
        if (i < x.length - 1)
            rfa += ' ';
    }
    setCookie('LastFieldSelect', arr, 0);
    x = document.getElementById("rfa");
    x.value = rfa;
    //alert(rfa);
*/

    //disable unset fields to avoid query string clutter
    var f = document.forms[1];
    for (var i = 0; i < f.length; i++) {
        var e = f.elements[i];

        if (e.disabled)
            continue;

        //will deal with operators in a moment
        if (e.name.search(/_op/) != -1)
            continue;

        if (e.type == 'text') {
            if (e.value == '')
                dis = true;
            else
                dis = false;
        } else {
            if (e.selectedIndex < 1)
                dis = true;
            else
                dis = false;
        }

        if (dis) {
            var opname = e.name + '_op';
            if (e.name.search(/\[\]/) != -1)
                opname = e.name.substr(0, e.name.length - 2) + '_op';

            var op = document.getElementsByName(opname)
            for (j = 0; j < op.length; j++)
                op[j].disabled = true;
            e.disabled = true;
        }
    }

    return true;
}
