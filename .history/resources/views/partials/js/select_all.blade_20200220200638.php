        $("{{ $global_selector }}").on("click", "{{ $local_selector }}", function(event) {
            console.log(this, $(this));
        });
