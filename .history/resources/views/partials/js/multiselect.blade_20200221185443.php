        $("{{ $global_selector }}").on("click", "{{ $local_selector }}", function(event) {
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
        });
