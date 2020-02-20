        $("{{ $global_selector }}").on("click", "{{ $local_selector }}", function(event) {
            var checkBoxAll = $(this);
            var checkBoxes = $(this).closest('table').find('input[type=checkbox]').not(checkBoxAll);
            console.log(event, checkBoxAll, checkBoxes);
        });
