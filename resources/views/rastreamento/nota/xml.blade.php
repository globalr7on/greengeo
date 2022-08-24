
<html>
<body>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#upload").bind("click", function () {
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xml)$/;
                if (regex.test($("#fileUpload").val().toLowerCase())) {
                    if (typeof (FileReader) != "undefined") {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var xmlDoc = $.parseXML(e.target.result);
                            var customers = $(xmlDoc).find("Customer");
 
                            //Create a HTML Table element.
                            var table = $("<table />");
                            table[0].border = "1";
 
                            //Add the header row.
                            var row = $(table[0].insertRow(-1));
                            customers.eq(0).children().each(function () {
                                var headerCell = $("<th />");
                                headerCell.html(this.nodeName);
                                row.append(headerCell);
                            });
 
                            //Add the data rows.
                            $(customers).each(function () {
                                row = $(table[0].insertRow(-1));
                                $(this).children().each(function () {
                                    var cell = $("<td />");
                                    cell.html($(this).text());
                                    row.append(cell);
                                });
                            });
 
                            var dvTable = $("#dvTable");
                            dvTable.html("");
                            dvTable.append(table);
                        }
                        reader.readAsText($("#fileUpload")[0].files[0]);
                    } else {
                        alert("This browser does not support HTML5.");
                    }
                } else {
                    alert("Please upload a valid XML file.");
                }
            });
        });
    </script>
    <input type="file" id="fileUpload" />
    <input type="button" id="upload" value="Upload" />
    <hr />
    <div id="dvTable">
    </div>
</body>
</html>