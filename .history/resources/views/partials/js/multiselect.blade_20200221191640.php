        var refreshMassEditButton;

        $("{{ $table_id }}").on("click", "input[type=checkbox]:not({{ $local_selector }})", refreshMassEditButton = function(event) {
            if (this === window) return false;

            var parent = $(this).closest('table');
            var checkBoxAll = parent.find("{{ $local_selector }}");
            var checkBoxes = parent.find("input[type=checkbox]").not(checkBoxAll);

            // COLLECT IDs OF CHECKED ITEMS
            var IDs = [];
            checkBoxes.each(function(checkBox) {
                console.log(checkBox, checkBox.checked);
                if (checkBox.checked === true) IDs.push(checkBox.val());
            });

            console.log(IDs);

            /*
            // MODIFY EDIT BUTTON
            var place = parent.find("thead th:last-child");
            if (place.length > 0) {
                var button = place.find("a[name=massEditButton]");
                if (button.length === 0) {
                    button = $("<a name=\"massEditButton\" class=\"btn btn-primary m-1\" ><i class=\"fas fa-fw fa-pen\"></i></a>");
                    var appendingPlace = place.find("button");
                    if (appendingPlace.length == 0) place.append(button);
                    else appendingPlace.before(button);
                }
                button.attr("href", "{{ route('disease.edit', '') }}/");
            }
            */
        });
        
        $("{{ $table_id }} {{ $global_selector }}").on("click", "{{ $local_selector }}", function(event) {
            var checkBoxAll = $(this);

            if (checkBoxAll.length == 0) return false;

            // FIND PARENT TABLE CONTAINING ALL CHECKBOXES
            var parent;
            var checkBoxes = parent = $(this).closest('table');

            // THEN FIND ALL CHECKBOXES INSIDE THAT TABLE
            // INCLUDING CHECKBOX FOR SELECT ALL
            checkBoxes = checkBoxes.find('input[type=checkbox]');

            // THEN REMOVE ONLY CHECKBOX FOR SELECT ALL FROM COLLECTION
            checkBoxes = checkBoxes.not(checkBoxAll);

            // NOW CHANGE STATE
            checkBoxes.each(function() {
                this.checked = checkBoxAll[0].checked;
            });

            // REFRESH EDIT BUTTON
            refreshMassEditButton.call(checkBoxAll[0]);
        });
