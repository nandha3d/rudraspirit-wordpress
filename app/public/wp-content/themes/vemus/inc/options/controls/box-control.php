<?php
/**
 * Box control
 */
if (class_exists('WP_Customize_Control')) {

	class themesflat_BoxControls extends WP_Customize_Control {
		public $type = 'box-controls';

		public function render() {
			$id    = 'themesflat-options-control-' . $this->id;
			$class = 'themesflat-options-control themesflat-options-control-' . $this->type;

			if ( $this->value() )
				$this->class = 'active';

			if ( ! empty( $this->class ) )
				$class .= " {$this->class}";

			if ( empty( $this->label ) )
				$class .= ' no-label';

			?><li id="<?php  echo esc_attr( $id ); ?>" class="<?php  echo esc_attr( $class ) ?>">
				<h6 class="themesflat-options-control-title themesflat-title-option"> <?php echo esc_attr ($this->label); ?></h6>
				<?php $this->render_content(); ?>
			</li><?php
		}
		
		public function render_content() {
			$name = "_options-box-control-$this->id";
			$id = $this->id;
			themesflat_render_box_control($name,$this->value(),$id);			
		}
	}

	class themesflat_ResponsiveColumnsSwitch extends WP_Customize_Control {
		public $type = 'responsive-columns-switch';

		public function render() {
			$id    = 'themesflat-responsive-control-' . $this->id;
			$class = 'themesflat-responsive-control themesflat-responsive-control-' . $this->type;

			if ( $this->value() ) $this->class = 'active';
			if ( ! empty( $this->class ) ) $class .= " {$this->class}";
			if ( empty( $this->label ) ) $class .= ' no-label';

			?>
			<li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
				
				<?php $this->render_content(); ?>
			</li>
			<?php
		}

		public function render_content() {
			$name  = "_options-responsive-columns-switch-" . $this->id;
			$value = wp_parse_args($this->value(), array(
				'desktop' => 5,
				'tablet'  => 4,
				'mobile'  => 2,
			));
			$id    = $this->id;

			$devices = array(
				'desktop' => 'dashicons-desktop',
				'tablet'  => 'dashicons-tablet',
				'mobile'  => 'dashicons-smartphone',
			);

			$current = 'desktop'; // Default active
			?>
			<div class="tf-heading-col">
				<h6 class="themesflat-options-control-title themesflat-title-option"><?php echo esc_html($this->label); ?></h6>		
				<div class="tf-responsive-tabs">
					<?php foreach ($devices as $device => $icon): ?>
						<span class="tf-tab <?php if($device === $current) echo 'active'; ?>" data-device="<?php echo esc_attr($device); ?>">
							<i class="dashicons <?php echo esc_attr($icon); ?>"></i>
						</span>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="tf-responsive-inputs">
				<?php foreach ($devices as $device => $icon): ?>
					<input type="number"
						class="tf-input tf-<?php echo esc_attr($device); ?> <?php if($device !== $current) echo 'hidden'; ?>"
						min="1" max="10"
						data-device="<?php echo esc_attr($device); ?>"
						value="<?php echo esc_attr($value[$device]); ?>"
					/>
				<?php endforeach; ?>
			</div>

			<input type="hidden"
				name="<?php echo esc_attr( $name ); ?>"
				id="<?php echo esc_attr( $id ); ?>"
				value='<?php echo esc_attr( json_encode($value) ); ?>'
				<?php $this->link(); ?>
			/>

			<script>
			(function($){
				wp.customize.bind('ready', function(){
					let wrapper = $('#<?php echo esc_js( 'themesflat-responsive-control-' . $this->id ); ?>');

					function setDevice(device) {
						wrapper.find('.tf-tab').removeClass('active');
						wrapper.find('.tf-tab[data-device="' + device + '"]').addClass('active');

						wrapper.find('.tf-input').addClass('hidden');
						wrapper.find('.tf-' + device).removeClass('hidden');
					}

					// Click on tab → change input + preview
					wrapper.find('.tf-tab').on('click', function(){
						let selected = $(this).data('device');
						setDevice(selected);

						if ( wp.customize && wp.customize.previewedDevice ) {
							wp.customize.previewedDevice.set(selected);
						}
					});

					// Change values → sync to hidden field
					wrapper.find('.tf-input').on('input change', function(){
						let data = {};
						wrapper.find('.tf-input').each(function(){
							data[$(this).data('device')] = parseInt($(this).val()) || 1;
						});
						wrapper.find('input[type="hidden"]').val(JSON.stringify(data)).trigger('change');
					});

					// If user switches device using Customizer button
					if ( wp.customize && wp.customize.previewedDevice ) {
						wp.customize.previewedDevice.bind(function(device){
							setDevice(device);
						});
					}
				});
			})(jQuery);
			</script>
			<?php
		}
	}
	
	
}