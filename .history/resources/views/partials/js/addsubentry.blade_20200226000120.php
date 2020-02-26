        var elements = {{ $elements }};
        var token = $("input[type=hidden][name=_token]").first();
        
        var add = function(clickedElement, elements) {
            var selectorContainer = $('<div class="d-flex flex-nowrap row mb-2 w-100"></div>');

            var selector = $('<select class="form-control d-inline-block" form="diseaseUpdate"><option value=""></option></select>');
            for (e in elements) {
                selector.append('<option value="' + e + '">' + elements[e] + '</option>');
            }

            var previous = clickedElement.closest('div').prev().find('select');

            selector.attr({
                id: previous.attr('id'),
                name: previous.attr('name')
            });

            selectorContainer.append(selector);

            var deleteButton = $('<form action="" method="POST"><input type="hidden" name="_method" value="DELETE"><button type="submit" class="btn btn-danger ml-2 mb-1"><i class="fas fa-fw fa-times"></i></button></form>');
            deleteButton.find('input:first').before(token);

            selectorContainer.append(deleteButton);

            clickedElement.closest('div').before(selectorContainer);
        };

        var remove = function(clickedElement) {
            clickedElement.closest('div').detach();
        };

        var container = $("{{ $container }}");

        if (container.length > 0) {
            // ADD BUTTON
            container.on("click", "{{ $button_add }}", function(element, index) {
                element.stopPropagation();
                element.preventDefault();
                add($(this), elements);
                return false;
            });
            
            container.on("click", "{{ $button_delete }}", function(element, index) {
                element.stopPropagation();
                element.preventDefault();
                remove($(this));
                return false;
            });
        }
