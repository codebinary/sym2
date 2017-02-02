$(document).ready(function () {
        $("#export").click(function () {
            $("#tableContact").excelexportjs({
                containerid: "tableContact"
               , datatype: 'table'
            });
        });
    });