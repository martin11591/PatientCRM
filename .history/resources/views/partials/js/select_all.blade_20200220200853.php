        $("{{ $global_selector }}").on("click", "{{ $local_selector }}", function(event) {
            var checkBoxAll = $(this);
            var checkBoxes = $(this).parent('table').find('input[type=checkbox]').remove(checkBoxAll);
            console.log(event, checkBoxAll, checkBoxes);
        });
