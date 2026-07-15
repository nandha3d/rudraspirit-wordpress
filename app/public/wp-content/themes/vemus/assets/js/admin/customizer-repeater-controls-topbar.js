
(function($){
	function initRepeaterContainer($container) {
        if (!$container || !$container.length) return;

        var $hidden = $container.find('.repeater-hidden');
        var $list   = $container.find('.sortable-list');
        var tplHtml = $container.find('.tmpl-repeater-item').html() || '';

        function updateValue(){
            var data = [];
            $container.find('.repeater-select').each(function(){
                data.push($(this).val());
            });
            $hidden.val(JSON.stringify(data)).trigger('change');
        }

        // ensure sortable applied only once
        if ($.fn.sortable && !$list.data('sortable-inited')) {
            $list.sortable({
                handle: '.handle',
                update: updateValue
            });
            $list.data('sortable-inited', true);
        }

        // if there are existing items, ensure updateValue is called to sync hidden
        updateValue();
    }

    $(function(){
        $('.themesflat-repeater-select').each(function(){
            initRepeaterContainer($(this));
        });
    });

    $(document)
        // change selects
        .on('change', '.themesflat-repeater-select .repeater-select', function(){
            var $container = $(this).closest('.themesflat-repeater-select');
            var data = [];
            $container.find('.repeater-select').each(function(){
                data.push($(this).val());
            });
            $container.find('.repeater-hidden').val(JSON.stringify(data)).trigger('change');
        })

        .on('click', '.themesflat-repeater-select .add-item', function(e){
            e.preventDefault();
            var $container = $(this).closest('.themesflat-repeater-select');
            var tplHtml = $container.find('.tmpl-repeater-item').html() || '';
            if (!tplHtml) {
                // debug: template missing
                console.warn('themesflat-repeater: template missing for', $container);
                return;
            }
            var $item = $(tplHtml);
            $container.find('.sortable-list').append($item);
            // trigger update
            $container.find('.repeater-select').first().trigger('change');
            // init sortable if needed
            if ($.fn.sortable) {
                $container.find('.sortable-list').sortable('refresh');
            }
            // ensure container initialized
            initRepeaterContainer($container);
        })

        .on('click', '.themesflat-repeater-select .remove-item', function(e){
            e.preventDefault();
            var $container = $(this).closest('.themesflat-repeater-select');
            $(this).closest('.repeater-item').remove();
            var data = [];
            $container.find('.repeater-select').each(function(){
                data.push($(this).val());
            });
            $container.find('.repeater-hidden').val(JSON.stringify(data)).trigger('change');
        });

    if (typeof wp !== 'undefined' && wp.customize) {
        wp.customize.bind('ready', function(){
            $('.themesflat-repeater-select').each(function(){
                initRepeaterContainer($(this));
            });
        });
    }

})(jQuery);

