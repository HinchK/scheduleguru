var ConvertEventsTable = function () {

    var initTable = function () {
        var table = $('#events_table');

        /* Formatting function for row details */
        function fnFormatDetails(oTable, nTr) {
            var aData = oTable.fnGetData(nTr);
            var sOut = '<table>';
            sOut += '<tr><td>Platform(s):</td><td>' + aData[2] + '</td></tr>';
            sOut += '<tr><td>Engine version:</td><td>' + aData[3] + '</td></tr>';
            sOut += '<tr><td>CSS grade:</td><td>' + aData[4] + '</td></tr>';
            sOut += '<tr><td>Others:</td><td>Could provide a link here</td></tr>';
            sOut += '</table>';

            return sOut;
        }

        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement('th');
        nCloneTh.className = "table-checkbox";
        nCloneTh.innerText = "Edit";
        var nCloneTd = document.createElement('td');
        nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';

        table.find('thead tr').each(function () {
            this.insertBefore(nCloneTh, this.childNodes[0]);
        });

        table.find('tbody tr').each(function () {
            this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
        });

        /*
         * Initialize DataTables, with no sorting on the 'details' column
         */
        var oTable = table.dataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": [0]
            }],
            "order": [
                [1, 'asc']
            ],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10
        });
        var tableWrapper = $('#events_table_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper

        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        table.on('click', ' tbody td .row-details', function () {
            var nTr = $(this).parents('tr')[0];
            if (oTable.fnIsOpen(nTr)) {
                /* This row is already open - close it */
                $(this).addClass("row-details-close").removeClass("row-details-open");
                oTable.fnClose(nTr);
            } else {
                /* Open this row */
                $(this).addClass("row-details-open").removeClass("row-details-close");
                oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
            }
        });
    };

    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            initTable();
        }

    };

}();