        $("{{ $global_selector }}").on("click", "{{ $local_selector }}", function(event) {
            var checkBoxAll = $(this);

            if (checkBoxAll.length == 0) return false;

            // FIND PARENT TABLE CONTAINING ALL CHECKBOXES
            var checkBoxes = $(this).closest('table');

            // THEN FIND ALL CHECKBOXES INSIDE THAT TABLE
            // INCLUDING CHECKBOX FOR SELECT ALL
            checkBoxes = checkBoxes.find('input[type=checkbox]');

            // THEN REMOVE ONLY CHECKBOX FOR SELECT ALL FROM COLLECTION
            checkBoxes = checkBoxes.not(checkBoxAll);

            // NOW CHANGE STATE
            checkBoxes.each(function() {
                this.checked = checkBoxAll[0].checked;
            });
        });
