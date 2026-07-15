(function($){
    'use strict';

    function initRepeater($container) {
        if (!$container.length || $container.data('init')) return;
        $container.data('init', true);

        var $list = $container.find('.repeater-list');
        var $hidden = $container.find('.repeater-value');
        var tplHtml = $container.find('.tmpl-repeater-item').html();
        var type = $container.data('type');

        function updateTitles() {
            $list.find('.repeater-item').each(function(i){
                $(this).find('.box-title').text('Icon Box ' + (i + 1));
            });
        }

        function updateValue() {
            var items = [];
            $list.find('.repeater-item').each(function(){
                var icon = $(this).find('.tf-icon-field').val();
                var title = $(this).find('.title-field').val();
                var description = $(this).find('.description-field').val();

                var data = { icon, title };
                if (type === 'iconbox2') data.description = description || '';

                items.push(data);
            });
            $hidden.val(JSON.stringify(items)).trigger('change');
        }

        $container.on('click', '.add-item', function(e){
            e.preventDefault();
            var $item = $(tplHtml);
            $list.append($item);
            updateTitles();
            updateValue();
        });

        $container.on('click', '.remove-item', function(e){
            e.preventDefault();
            $(this).closest('.repeater-item').remove();
            updateTitles();
            updateValue();
        });

        $container.on('input change', 'textarea, input', updateValue);

        updateTitles();
        updateValue();
    }

    function initAllRepeaters() {
        $('.repeater-container').each(function(){
            initRepeater($(this));
        });
    }

    $(document).ready(function(){
        initAllRepeaters();

        if (window.MutationObserver) {
            new MutationObserver(function(mutations){
                mutations.forEach(function(m){
                    $(m.addedNodes).each(function(){
                        var $node = $(this);
                        if ($node.find('.repeater-container').length) {
                            initAllRepeaters();
                        }
                    });
                });
            }).observe(document.body, { childList: true, subtree: true });
        }
    });

})(jQuery);
