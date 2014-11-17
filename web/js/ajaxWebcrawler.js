function loadImportStateDetail(url, runNumber) {
    $.post(
        url,
        {
            runNumber: runNumber
        },
        function (data) {
            $('#webcrawler_detail_log').html(data);
        }
    );
}

function loadFeedItemStructure(url, feedUrl) {
    $.post(
        url,
        {
            feedUrl: feedUrl
        },
        function (data) {
            $('#webcrawler_feed_item_structure').html(data);
        }
    );
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    
    var articleAttribute = ev.target.id;
    var feedAttribute = data;
    var mapping = $("#webcrawler-specialmapping").val();
    if (mapping.indexOf(articleAttribute + "=") >= 0) {
        var oldItem = mapping.substring(mapping.indexOf(articleAttribute + "=") + articleAttribute.length + 1);
        oldItem = oldItem.substring(0, oldItem.indexOf(";"));
        $("#webcrawler-specialmapping").val(mapping.replace(oldItem + ";", feedAttribute + ";"));
    } else if (mapping.indexOf("=" + feedAttribute) >= 0) {
        var oldItem = mapping.substring(0, mapping.indexOf("=" + feedAttribute) + feedAttribute.length + 1);
        oldItem = oldItem.substring(0, oldItem.indexOf("="));
        $("#webcrawler-specialmapping").val(mapping.replace(oldItem + "=", articleAttribute + "="));
    } else if (mapping.indexOf(articleAttribute + "=" + feedAttribute + "; ") < 0) {
        $("#webcrawler-specialmapping").val(mapping + ev.target.id + "=" + data + "; ");
    }
}
