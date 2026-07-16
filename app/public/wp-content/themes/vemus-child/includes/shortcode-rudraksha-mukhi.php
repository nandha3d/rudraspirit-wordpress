<?php
/**
 * Universal Rudraksha Mukhi Shortcode & Interactive Showcase
 * Registers [rudraksha_mukhi mukhi="1"] shortcode.
 *
 * @package Vemus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! function_exists( 'vemus_rudraksha_mukhi_shortcode' ) ) {

    function vemus_rudraksha_mukhi_shortcode( $atts ) {
        $atts = shortcode_atts(
            array(
                'mukhi'         => 0,
                'show_top_card' => 'yes',
                'initial_tab'   => 'overview',
            ),
            $atts,
            'rudraksha_mukhi'
        );

        $mukhi_num = intval( $atts['mukhi'] );

        // If not explicitly provided, detect from page ID or post title
        if ( $mukhi_num < 1 || $mukhi_num > 14 ) {
            if ( function_exists( 'Vemus_Rudraksha_Data::get_mukhi_by_page_id' ) && get_the_ID() ) {
                $mukhi_num = Vemus_Rudraksha_Data::get_mukhi_by_page_id( get_the_ID() );
            }
        }

        // If still 0, try parsing title
        if ( ( $mukhi_num < 1 || $mukhi_num > 14 ) && get_the_title() ) {
            if ( preg_match( '/\b([1-9]|1[0-4])\b[- ]?Mukhi/i', get_the_title(), $matches ) ) {
                $mukhi_num = intval( $matches[1] );
            }
        }

        if ( $mukhi_num < 1 || $mukhi_num > 14 ) {
            $mukhi_num = 1;
        }

        if ( ! class_exists( 'Vemus_Rudraksha_Data' ) ) {
            return '<div class="rudraksha-error">Error: Vemus_Rudraksha_Data class not loaded.</div>';
        }

        $all_data  = Vemus_Rudraksha_Data::get_all();
        $all_prods = Vemus_Rudraksha_Data::get_all_products();

        // Prepare JSON for Alpine.js dynamic switching
        $all_json       = json_encode( $all_data );
        $all_prods_json = json_encode( $all_prods );

        // Ensure Alpine.js is enqueued
        if ( function_exists( 'vemus_child_enqueue_alpine' ) ) {
            vemus_child_enqueue_alpine();
        }

        ob_start();
        ?>
        <div class="rudraksha-showcase-wrapper" 
             x-data="vemusRudrakshaShowcase(<?php echo intval( $mukhi_num ); ?>, <?php echo esc_attr( $all_json ); ?>, <?php echo esc_attr( $all_prods_json ); ?>)"
             x-init="initShowcase()">

            <?php if ( 'yes' === strtolower( $atts['show_top_card'] ) ) : ?>
                <!-- ========================================================
                     SECTION 1: TOP PRODUCT CARD HEADER
                     ======================================================== -->
                <div class="rudraksha-top-card glass-card">
                    <div class="rudraksha-top-card__inner">
                        
                        <!-- Left: Bead Visual & Floating Halo -->
                        <div class="rudraksha-top-card__visual">
                            <div class="rudraksha-circle-container">
                                <div class="rudraksha-bead-halo"></div>
                                <div class="rudraksha-bead-circle">
                                    <img :src="currentProduct.image_url ? currentProduct.image_url : currentData.image_fallback" 
                                         :alt="currentData.name" 
                                         class="rudraksha-bead-img"
                                         loading="lazy"
                                         @error="$event.target.src = currentData.image_fallback" />
                                </div>
                            </div>
                            <div class="rudraksha-badge-pill" x-text="currentData.badge"></div>
                        </div>

                        <!-- Right: Vedic Summary & CTA -->
                        <div class="rudraksha-top-card__info">
                            <span class="rudraksha-sub-label">Vedic Sovereign Heritage</span>
                            <h2 class="rudraksha-main-title" x-text="currentData.name"></h2>
                            <p class="rudraksha-tagline-text" x-text="currentData.title_tagline"></p>

                            <!-- Quick Vedic Attributes Grid -->
                            <div class="rudraksha-attributes-grid">
                                <div class="rudraksha-attr-item">
                                    <span class="attr-icon">🕉️</span>
                                    <div class="attr-text">
                                        <label>Ruling Deity</label>
                                        <strong x-text="currentData.deity"></strong>
                                    </div>
                                </div>
                                <div class="rudraksha-attr-item">
                                    <span class="attr-icon">🪐</span>
                                    <div class="attr-text">
                                        <label>Ruling Planet</label>
                                        <strong x-text="currentData.planet"></strong>
                                    </div>
                                </div>
                                <div class="rudraksha-attr-item">
                                    <span class="attr-icon">🧘</span>
                                    <div class="attr-text">
                                        <label>Associated Chakra</label>
                                        <strong x-text="currentData.chakra"></strong>
                                    </div>
                                </div>
                                <div class="rudraksha-attr-item">
                                    <span class="attr-icon">📿</span>
                                    <div class="attr-text">
                                        <label>Beej Mantra</label>
                                        <strong x-text="currentData.mantra_english"></strong>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA & Price Row -->
                            <div class="rudraksha-cta-row">
                                <div class="rudraksha-price-display" x-html="currentProduct.price_html"></div>
                                <a :href="currentProduct.url" class="rudraksha-shop-btn tf-btn" target="_self">
                                    <span x-text="'Shop Authentic ' + currentData.number + ' Mukhi Now →'"></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ========================================================
                 SECTION 2: INTERACTIVE 4-TAB SACRED PORTAL
                 ======================================================== -->
            <div class="rudraksha-tabs-container" @mouseenter="pauseAutoTab()" @mouseleave="resumeAutoTab()">
                
                <!-- Tab Navigation Buttons -->
                <nav class="rudraksha-tab-nav" role="tablist">
                    <button type="button" 
                            class="rudraksha-tab-btn" 
                            :class="{ 'is-active': activeTab === 'overview' }"
                            @click="selectTab('overview')" role="tab">
                        <span class="tab-icon">📖</span>
                        <span class="tab-label">Overview & Lore</span>
                    </button>
                    <button type="button" 
                            class="rudraksha-tab-btn" 
                            :class="{ 'is-active': activeTab === 'benefits' }"
                            @click="selectTab('benefits')" role="tab">
                        <span class="tab-icon">✨</span>
                        <span class="tab-label">Divine Benefits</span>
                    </button>
                    <button type="button" 
                            class="rudraksha-tab-btn" 
                            :class="{ 'is-active': activeTab === 'ritual' }"
                            @click="selectTab('ritual')" role="tab">
                        <span class="tab-icon">📿</span>
                        <span class="tab-label">Wearing Ritual</span>
                    </button>
                    <button type="button" 
                            class="rudraksha-tab-btn" 
                            :class="{ 'is-active': activeTab === 'mantra' }"
                            @click="selectTab('mantra')" role="tab">
                        <span class="tab-icon">🕉️</span>
                        <span class="tab-label">108 Japa Counter</span>
                    </button>
                </nav>

                <!-- Tab Content Panels -->
                <div class="rudraksha-tab-content glass-panel">
                    
                    <!-- TAB 1: OVERVIEW & LORE -->
                    <div x-show="activeTab === 'overview'" 
                         x-transition:enter="tab-fade-enter" 
                         class="rudraksha-tab-panel">
                        <div class="rudraksha-overview-header">
                            <h3 class="panel-heading" x-text="'Sacred Significance of ' + currentData.name"></h3>
                            <div class="golden-divider"><span class="dot">◆</span></div>
                        </div>
                        <div class="rudraksha-overview-body" x-html="currentData.overview"></div>
                    </div>

                    <!-- TAB 2: DIVINE BENEFITS GRID -->
                    <div x-show="activeTab === 'benefits'" 
                         x-transition:enter="tab-fade-enter" 
                         class="rudraksha-tab-panel" x-cloak>
                        <div class="rudraksha-overview-header">
                            <h3 class="panel-heading">Categorized Blessings & Transformations</h3>
                            <p class="panel-subheading">Hover over each domain to explore the physical, mental, and spiritual mastery awakened by this sacred bead.</p>
                            <div class="golden-divider"><span class="dot">◆</span></div>
                        </div>

                        <div class="rudraksha-benefits-grid">
                            <!-- Spiritual Category -->
                            <div class="benefit-category-column" x-if="currentData.benefits.spiritual">
                                <div class="category-header spiritual-theme">
                                    <span class="cat-icon">⚡</span>
                                    <h4>Spiritual & Meditative</h4>
                                </div>
                                <div class="category-cards">
                                    <template x-for="(item, idx) in currentData.benefits.spiritual" :key="idx">
                                        <div class="benefit-card">
                                            <h5 x-text="item.title"></h5>
                                            <p x-text="item.desc"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Mental & Emotional Category -->
                            <div class="benefit-category-column" x-if="currentData.benefits.mental">
                                <div class="category-header mental-theme">
                                    <span class="cat-icon">🧠</span>
                                    <h4>Mental & Emotional</h4>
                                </div>
                                <div class="category-cards">
                                    <template x-for="(item, idx) in currentData.benefits.mental" :key="idx">
                                        <div class="benefit-card">
                                            <h5 x-text="item.title"></h5>
                                            <p x-text="item.desc"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Career & Wealth Category -->
                            <div class="benefit-category-column" x-if="currentData.benefits.career_wealth">
                                <div class="category-header wealth-theme">
                                    <span class="cat-icon">👑</span>
                                    <h4>Career, Wealth & Power</h4>
                                </div>
                                <div class="category-cards">
                                    <template x-for="(item, idx) in currentData.benefits.career_wealth" :key="idx">
                                        <div class="benefit-card">
                                            <h5 x-text="item.title"></h5>
                                            <p x-text="item.desc"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Ayurvedic Health Category -->
                            <div class="benefit-category-column" x-if="currentData.benefits.health">
                                <div class="category-header health-theme">
                                    <span class="cat-icon">🌿</span>
                                    <h4>Ayurvedic & Health Shield</h4>
                                </div>
                                <div class="category-cards">
                                    <template x-for="(item, idx) in currentData.benefits.health" :key="idx">
                                        <div class="benefit-card">
                                            <h5 x-text="item.title"></h5>
                                            <p x-text="item.desc"></p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: WEARING RITUAL TIMELINE -->
                    <div x-show="activeTab === 'ritual'" 
                         x-transition:enter="tab-fade-enter" 
                         class="rudraksha-tab-panel" x-cloak>
                        <div class="rudraksha-overview-header">
                            <h3 class="panel-heading">Vedic Consecration & Wearing Guide</h3>
                            <p class="panel-subheading">Follow these sacred steps to perform Prana Pratishta and awaken the full potency of your Rudraksha.</p>
                            <div class="golden-divider"><span class="dot">◆</span></div>
                        </div>

                        <div class="rudraksha-ritual-timeline">
                            <div class="ritual-step">
                                <div class="step-num">1</div>
                                <div class="step-content">
                                    <h4>Auspicious Day & Timing</h4>
                                    <p x-text="currentData.wearing_ritual.day_time"></p>
                                </div>
                            </div>
                            <div class="ritual-step">
                                <div class="step-num">2</div>
                                <div class="step-content">
                                    <h4>Purification & Altar Preparation</h4>
                                    <p x-text="currentData.wearing_ritual.purification"></p>
                                </div>
                            </div>
                            <div class="ritual-step">
                                <div class="step-num">3</div>
                                <div class="step-content">
                                    <h4>Capping & Threading Specifications</h4>
                                    <p x-text="currentData.wearing_ritual.capping"></p>
                                </div>
                            </div>
                            <div class="ritual-step">
                                <div class="step-num">4</div>
                                <div class="step-content">
                                    <h4>108 Beej Mantra Consecration</h4>
                                    <p x-text="currentData.wearing_ritual.chanting"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: INTERACTIVE 108 JAPA COUNTER & MANTRA -->
                    <div x-show="activeTab === 'mantra'" 
                         x-transition:enter="tab-fade-enter" 
                         class="rudraksha-tab-panel" x-cloak>
                        <div class="rudraksha-overview-header">
                            <h3 class="panel-heading">Sacred Beej Mantra & Interactive Japa</h3>
                            <p class="panel-subheading">Chant the divine vibrations 108 times before wearing your Rudraksha or during your daily dhyana.</p>
                            <div class="golden-divider"><span class="dot">◆</span></div>
                        </div>

                        <div class="rudraksha-japa-box">
                            <!-- Vedic Beej Mantra Card (Clean English) -->
                            <div class="mantra-display-card">
                                <span class="mantra-label">Vedic Beej Mantra (Chant 108 Times)</span>
                                <div class="english-mantra-title" style="font-size: 17px; font-weight: 600; color: #d68019; letter-spacing: 0.5px; margin-top: 6px;" x-text="currentData.mantra_english"></div>
                            </div>

                            <!-- Interactive 108 Counter -->
                            <div class="japa-counter-widget">
                                <div class="japa-progress-ring">
                                    <svg class="progress-svg" viewBox="0 0 120 120">
                                        <circle class="ring-bg" cx="60" cy="60" r="52"></circle>
                                        <circle class="ring-active" cx="60" cy="60" r="52"
                                                :style="'stroke-dashoffset: ' + (326.72 - (326.72 * japaCount / 108))"></circle>
                                    </svg>
                                    <div class="japa-number-display">
                                        <span class="count-value" x-text="japaCount"></span>
                                        <span class="count-target">/ 108</span>
                                    </div>
                                </div>

                                <div class="japa-controls">
                                    <button type="button" class="japa-tap-btn tf-btn" @click="toggleAutoJapa()" :style="japaIsRunning ? 'background: #2b2b2b; color: #fff;' : ''">
                                        <span x-text="japaIsRunning ? '⏸ Pause Automatic Chanting' : (japaCount >= 108 ? '🔄 Restart 108 Chants' : '▶ Start Automatic Chanting (1 by 1)')"></span>
                                    </button>
                                    <button type="button" class="japa-manual-tap tf-btn" style="background: transparent; border: 1px solid rgba(214, 128, 25, 0.4); color: inherit; font-size: 13px; padding: 6px 14px;" @click="incrementJapa()" x-show="!japaIsRunning && japaCount < 108">
                                        <span>📿 Manual Tap +1</span>
                                    </button>
                                    <button type="button" class="japa-reset-btn" @click="resetJapa()" x-show="japaCount > 0 && !japaIsRunning">
                                        <span>Reset Counter</span>
                                    </button>
                                </div>

                                <div class="japa-completion-alert" x-show="japaComplete" x-transition>
                                    🎉 Divine Consecration Complete! You have completed 108 sacred chants of the Beej Mantra.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ========================================================
                 SECTION 3: ALL 14 MUKHI QUICK EXPLORER CAROUSEL
                 ======================================================== -->
            <div class="rudraksha-quick-explorer">
                <div class="explorer-header">
                    <h4>Explore All 14 Sacred Rudraksha Beads</h4>
                    <p>Select any Mukhi below to view its Vedic lore, benefits, and mantras instantly.</p>
                </div>
                <div class="rudraksha-pills-carousel">
                    <template x-for="num in 14" :key="num">
                        <button type="button" 
                                class="rudraksha-pill-btn" 
                                :class="{ 'is-current': activeMukhi === num }"
                                @click="switchMukhi(num)">
                            <span class="pill-num" x-text="num + ' Mukhi'"></span>
                        </button>
                    </template>
                </div>
            </div>

        </div>

        <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('vemusRudrakshaShowcase', (initialMukhi, allData, allProds) => ({
                activeMukhi: initialMukhi,
                allMukhis: allData,
                allProducts: allProds,
                currentData: allData[initialMukhi] || allData[1],
                currentProduct: allProds[initialMukhi] || allProds[1],
                activeTab: '<?php echo esc_js( $atts['initial_tab'] ); ?>',
                japaCount: 0,
                japaComplete: false,
                japaIsRunning: false,
                japaAutoTimer: null,
                tabAutoTimer: null,
                isPaused: false,
                tabList: ['overview', 'benefits', 'ritual', 'mantra'],

                initShowcase() {
                    this.startAutoTab();
                },

                startAutoTab() {
                    if (this.tabAutoTimer) clearInterval(this.tabAutoTimer);
                    this.tabAutoTimer = setInterval(() => {
                        if (!this.isPaused) {
                            let currentIdx = this.tabList.indexOf(this.activeTab);
                            let nextIdx = (currentIdx + 1) % this.tabList.length;
                            this.activeTab = this.tabList[nextIdx];
                        }
                    }, 5500);
                },

                pauseAutoTab() {
                    this.isPaused = true;
                },

                resumeAutoTab() {
                    this.isPaused = false;
                },

                selectTab(tabName) {
                    this.activeTab = tabName;
                    this.isPaused = true; // Pause autoplay when user clicks a tab
                },

                toggleAutoJapa() {
                    this.isPaused = true;
                    if (this.japaIsRunning) {
                        this.stopAutoJapa();
                    } else {
                        if (this.japaCount >= 108) {
                            this.resetJapa();
                        }
                        this.japaIsRunning = true;
                        this.incrementJapa();
                        this.japaAutoTimer = setInterval(() => {
                            if (this.japaCount < 108 && this.japaIsRunning) {
                                this.incrementJapa();
                            } else {
                                this.stopAutoJapa();
                            }
                        }, 1200);
                    }
                },

                stopAutoJapa() {
                    this.japaIsRunning = false;
                    if (this.japaAutoTimer) {
                        clearInterval(this.japaAutoTimer);
                        this.japaAutoTimer = null;
                    }
                },

                incrementJapa() {
                    this.isPaused = true; // Pause tab autoplay during Japa chanting
                    if (this.japaCount < 108) {
                        this.japaCount++;
                        if (this.japaCount === 108) {
                            this.japaComplete = true;
                            this.stopAutoJapa();
                        }
                    } else {
                        this.stopAutoJapa();
                    }
                },

                resetJapa() {
                    this.stopAutoJapa();
                    this.japaCount = 0;
                    this.japaComplete = false;
                },

                switchMukhi(num) {
                    if (this.allMukhis[num]) {
                        this.stopAutoJapa();
                        this.activeMukhi = num;
                        this.currentData = this.allMukhis[num];
                        if (this.allProducts && this.allProducts[num]) {
                            this.currentProduct = this.allProducts[num];
                        }
                        this.japaCount = 0;
                        this.japaComplete = false;
                        this.activeTab = 'overview';
                        this.isPaused = false;
                        // Check if we should navigate directly if on a single page
                        const pageId = this.currentData.page_id;
                        if (pageId && window.location.href.includes('page_id=')) {
                            window.location.href = '<?php echo home_url('/?page_id='); ?>' + pageId;
                        }
                    }
                }
            }));
        });
        </script>
        <?php
        return ob_get_clean();
    }
}

if ( ! shortcode_exists( 'rudraksha_mukhi' ) ) {
    add_shortcode( 'rudraksha_mukhi', 'vemus_rudraksha_mukhi_shortcode' );
}
