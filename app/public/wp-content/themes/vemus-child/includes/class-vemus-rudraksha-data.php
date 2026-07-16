<?php
/**
 * Vemus Rudraksha Data Helper Class
 * Contains authentic, comprehensive Vedic datasets and product resolvers
 * for 1 Mukhi through 14 Mukhi Rudraksha beads.
 *
 * @package Vemus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vemus_Rudraksha_Data' ) ) {

    class Vemus_Rudraksha_Data {

        /**
         * Returns all 14 Mukhi datasets mapped by Mukhi number (1 to 14).
         *
         * @return array
         */
        public static function get_all() {
            return array(
                1 => array(
                    'number'         => 1,
                    'page_id'        => 1947,
                    'name'           => '1 Mukhi Rudraksha (Ek Mukhi)',
                    'title_tagline'  => 'The Sovereign Bead of Supreme Shiva & Liberation',
                    'badge'          => 'Extremely Rare • Consecrated Vedic Bead',
                    'deity'          => 'Lord Shiva (Paramashiva)',
                    'planet'         => 'Uranus / All Planets (Surya Mastery)',
                    'chakra'         => 'Sahasrara (Crown Chakra)',
                    'mantra_sanskrit'=> 'Aum Namah Sivaya / Aum Hreem Namah',
                    'mantra_english' => 'AUM NAMAH SIVAYA & AUM HREEM NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/NqUHUdYYo9vAsMFQWTB4yssfH82jdiVct7dDpdt0.webp') : '/wp-content/uploads/rudraksha/NqUHUdYYo9vAsMFQWTB4yssfH82jdiVct7dDpdt0.webp',
                    'overview'       => 'There is only one natural cleft or line on this sacred Rudraksha, depicting a single face (Mukhi). It represents Lord Shiva Himself and is revered as the King of all Rudrakshas. The genuine 1 Mukhi is among the rarest creations in nature. It traditionally manifests in two primary shapes: the round/oval form from Nepal and the crescent or half-moon (Kaju) shape from South India, Sri Lanka, and Java.<br><br>It is sacredly declared that Lord Paramashiva is fully present in the 1 Mukhi Rudraksha. Those blessed to wear or worship this supreme bead attain material success without attachment to lust or greed, bridging mundane achievement with the highest spiritual liberation (Moksha). Daily worship of the Ek Mukhi fulfills all righteous desires and awakens supreme divine consciousness.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Supreme Meditation & Dhyana', 'desc' => 'The most potent bead for deepening meditation, dhyana, and attaining super-conscious states of awareness.'),
                            array('title' => 'Destruction of Past Karma', 'desc' => 'Purifies past karmic debts and destroys sins accumulated over lifetimes, leading directly to spiritual liberation.'),
                            array('title' => 'Aura Shield & Negative Energy Protection', 'desc' => 'Constructs an impenetrable divine shield around the wearer, neutralizing evil eyes and lower astral energies.')
                        ),
                        'mental'        => array(
                            array('title' => 'Supreme Self-Confidence', 'desc' => 'Eliminates anxiety, hesitation, and self-doubt, bestowing unshakeable internal fortitude and calmness.'),
                            array('title' => 'Harmonic Emotional Balance', 'desc' => 'Softens the heart while strengthening the will, transforming the wearer into a compassionate, solicitous, and composed leader.'),
                            array('title' => 'Control Over Mental Chaos', 'desc' => 'Regulates chaotic mental fluctuations and balances the energetic currents within the nervous system.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Authoritative Leadership & Sovereignty', 'desc' => 'Bestows royal aura, executive promotion, and authoritative influence in professional and social spheres.'),
                            array('title' => 'Abundant Fortune & Luxury', 'desc' => 'Attracts sustainable wealth, luxury, and material fortune while keeping the mind detached and grounded.'),
                            array('title' => 'Desire Fulfillment (Sankalpa Siddhi)', 'desc' => 'Ensures that every noble goal and righteous aspiration undertaken by the wearer is brought to fruition.')
                        ),
                        'health'        => array(
                            array('title' => 'Neurological & Brain Health Support', 'desc' => 'Assists in harmonizing brain frequencies, alleviating chronic migraines, neurological disorders, and mental fatigue.'),
                            array('title' => 'Cardiovascular & Vitality Regulation', 'desc' => 'Supports healthy heart rhythm and blood pressure balance through meditative stillness.'),
                            array('title' => 'Holistic Pranic Vitalization', 'desc' => 'Rejuvenates cellular energy and promotes overall longevity and constitutional vigor.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Monday morning during Shukla Paksha (Waxing Moon), strictly before noon.',
                        'purification' => 'Wake up early, take a purifying bath, and wear clean, light-colored or white clothes. Sit facing East or North before your home altar.',
                        'capping'      => 'The bead should be studded in a clean Gold or Silver cap, or strung using consecrated red or white silk/wool thread.',
                        'chanting'     => 'Chant "AUM NAMAH SIVAYA" and "AUM HREEM NAMAH" exactly 108 times using a Japa mala while holding the bead before wearing.'
                    )
                ),
                2 => array(
                    'number'         => 2,
                    'page_id'        => 1938,
                    'name'           => '2 Mukhi Rudraksha (Do Mukhi)',
                    'title_tagline'  => 'The Divine Union of Shiva & Shakti (Ardhanareeshvara)',
                    'badge'          => 'Bead of Unity • Harmony • Emotional Bonding',
                    'deity'          => 'Lord Ardhanareeshvara (Shiva & Parvati)',
                    'planet'         => 'Moon (Chandra)',
                    'chakra'         => 'Swadhisthana (Sacral Chakra)',
                    'mantra_sanskrit'=> 'Aum Namah',
                    'mantra_english' => 'AUM NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/1PF8QuxEvdUbXtn5NqPzIp6rZbl59LkbKLCV4XW1.webp') : '/wp-content/uploads/rudraksha/1PF8QuxEvdUbXtn5NqPzIp6rZbl59LkbKLCV4XW1.webp',
                    'overview'       => 'The 2 Mukhi Rudraksha possesses two distinct natural lines dividing its surface. It represents Lord Ardhanareeshvara—the divine, indivisible union of Lord Shiva and Goddess Parvati (Purusha and Prakriti). Known as the "Deveshwar Rudraksha," it serves as a pure mirror of cosmic harmony and emotional grace.<br><br>Since it is governed by the Moon (Chandra), this sacred bead has a profoundly soothing and stabilizing influence on the emotional mind. It heals fragmented relationships, fosters mutual understanding, and aligns dualistic energies within the individual. It is the ultimate divine blessing for marriage, family togetherness, and partnerships of all kinds.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Shiva-Shakti Balance', 'desc' => 'Awakens both masculine (action/logic) and feminine (intuition/compassion) energies within the spiritual seeker.'),
                            array('title' => 'Spiritual Bliss & Inner Peace', 'desc' => 'Dispels inner conflict and spiritual dryness, filling the soul with deep contentment and divine pleasure.')
                        ),
                        'mental'        => array(
                            array('title' => 'Emotional Healing & Moon Balance', 'desc' => 'Cures the negative astrological effects of a weak or afflicted Moon, eliminating mood swings, depression, and overthinking.'),
                            array('title' => 'Memory & Cognitive Enhancement', 'desc' => 'Calms mental turbulence, directly enhancing memory retention, focus, and mental clarity.'),
                            array('title' => 'Deep Empathy & Compassion', 'desc' => 'Encourages patience, active listening, and unconditional warmth in personal interactions.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Harmonious Business Partnerships', 'desc' => 'Ensures trust, loyalty, and seamless cooperation between co-founders, employer-employee, and client relationships.'),
                            array('title' => 'Attracting the Ideal Life Partner', 'desc' => 'Highly beneficial for singles searching for their soulmate or compatible marital match.'),
                            array('title' => 'Marital & Family Unity', 'desc' => 'Resolves misunderstandings and discord between husband-wife, parent-child, and teacher-student.')
                        ),
                        'health'        => array(
                            array('title' => 'Kidney & Fluid Balance', 'desc' => 'Traditionally associated with supporting kidney vitality, bladder function, and bodily fluid regulation.'),
                            array('title' => 'Cardiorespiratory Support', 'desc' => 'Helps soothe stress-induced heart palpitations and lung-related breathing difficulties.'),
                            array('title' => 'Gastrointestinal & Digestive Harmony', 'desc' => 'Alleviates nervous stomach disorders, acid reflux, and gastroenteritis caused by emotional anxiety.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Monday morning before 12:00 Noon.',
                        'purification' => 'Bathe thoroughly and wear clean attire. Wash the bead gently with raw cow’s milk and holy water (Gangajal).',
                        'capping'      => 'Best worn capped in Silver or Gold, strung on a red or white silk thread.',
                        'chanting'     => 'Chant the sacred Beej Mantra "AUM NAMAH" 108 times with full reverence before wearing.'
                    )
                ),
                3 => array(
                    'number'         => 3,
                    'page_id'        => 1927,
                    'name'           => '3 Mukhi Rudraksha (Teen Mukhi)',
                    'title_tagline'  => 'The Sacred Fire of Purification & Rebirth (Agni Deva)',
                    'badge'          => 'Karmic Cleanser • Energy Booster • Courage',
                    'deity'          => 'Agni Deva (The Fire God)',
                    'planet'         => 'Mars (Mangal)',
                    'chakra'         => 'Manipura (Solar Plexus Chakra)',
                    'mantra_sanskrit'=> 'Aum Kleem Namah',
                    'mantra_english' => 'AUM KLEEM NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/4qLe22JoMxfJkyP0SW4vW8EkP1fhYzaE0CAYVL2L.webp') : '/wp-content/uploads/rudraksha/4qLe22JoMxfJkyP0SW4vW8EkP1fhYzaE0CAYVL2L.webp',
                    'overview'       => 'Featuring three natural clefts running from top to bottom, the 3 Mukhi Rudraksha is the direct embodiment of Agni Deva, the Lord of Fire. Just as fire purifies all that enters its flame without becoming impure, the 3 Mukhi burns away past karmic burdens, emotional trauma, and self-limiting fears.<br><br>Governed by the fiery planet Mars (Mangal) and resonating with the Solar Plexus (Manipura) chakra, this bead ignites inner vitality, willpower, and dynamic action. It transforms sluggishness into radiant energy, making it indispensable for those overcoming past setbacks or seeking liberation from inferiority complexes.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Incineration of Past Karma', 'desc' => 'Consumes karmic impressions of the past, allowing the wearer to step into a fresh, unburdened spiritual rebirth.'),
                            array('title' => 'Awakening Spiritual Fire', 'desc' => 'Kindles the inner spiritual flame (Tejas), accelerating meditative purification and aura illumination.')
                        ),
                        'mental'        => array(
                            array('title' => 'Freedom from Guilt & Shame', 'desc' => 'Liberates the psyche from deep-seated guilt, past trauma, and memories of failure.'),
                            array('title' => 'Conquering Laziness & Depression', 'desc' => 'Overcomes chronic lethargy, procrastination, and low vitality, instilling enthusiasm and zest for life.'),
                            array('title' => 'Unyielding Courage & Willpower', 'desc' => 'Eliminates timidity and stage fright, empowering the individual to face challenges head-on.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Dynamic Execution & Leadership', 'desc' => 'Enhances decision-making speed, ambition, and competitive edge in business and real estate.'),
                            array('title' => 'Overcoming Financial Stagnation', 'desc' => 'Breaks through obstacles hindering financial growth and professional advancement.'),
                            array('title' => 'Relief from Mangal Dosh', 'desc' => 'Mitigates malefic effects of Mars (Mangalik Dosh), bringing harmony to career and personal disputes.')
                        ),
                        'health'        => array(
                            array('title' => 'Digestive Fire (Jatharagni) Boost', 'desc' => 'Ignites metabolic efficiency, aiding in chronic indigestion, acidity, and liver function.'),
                            array('title' => 'Blood Purification & Circulation', 'desc' => 'Supports healthy blood flow and assists those dealing with low energy or anemia.'),
                            array('title' => 'Fever & Vitality Regulation', 'desc' => 'Traditionally used to strengthen the body’s natural resistance against weakness and fatigue.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Tuesday morning or Monday morning after sunrise.',
                        'purification' => 'Take a clean bath, light a pure ghee lamp (diya) and incense before Agni / Shiva.',
                        'capping'      => 'Set in Silver or Gold, or strung with red silk or woolen thread.',
                        'chanting'     => 'Chant "AUM KLEEM NAMAH" 108 times with unwavering focus before putting it on.'
                    )
                ),
                4 => array(
                    'number'         => 4,
                    'page_id'        => 1904,
                    'name'           => '4 Mukhi Rudraksha (Chaar Mukhi)',
                    'title_tagline'  => 'The Wisdom & Eloquence of Lord Brahma',
                    'badge'          => 'Intellect • Speech Mastery • Creativity',
                    'deity'          => 'Lord Brahma (The Creator)',
                    'planet'         => 'Mercury (Budha)',
                    'chakra'         => 'Vishuddha (Throat Chakra)',
                    'mantra_sanskrit'=> 'Aum Hreem Namah',
                    'mantra_english' => 'AUM HREEM NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/GftDrjgo5010YAOTIiGUa6sornHtCLYZQTCyTtwM.webp') : '/wp-content/uploads/rudraksha/GftDrjgo5010YAOTIiGUa6sornHtCLYZQTCyTtwM.webp',
                    'overview'       => 'The 4 Mukhi Rudraksha displays four distinct vertical lines and represents the four-headed Lord Brahma, the cosmic creator and master of the Vedas. It also symbolizes the four stages of human life (Brahmacharya, Grihastha, Vanaprastha, Sannyasa) and the four realms of consciousness.<br><br>Attuned to the planet Mercury (Budha) and the Throat Chakra (Vishuddha), this bead is the supreme catalyst for intellectual brilliance, memory, vocal eloquence, and artistic creativity. It dissolves stuttering, shyness, and mental fog, making it the ultimate talisman for scholars, students, writers, teachers, and public speakers.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Vedic Knowledge & Insight', 'desc' => 'Grants intuitive access to spiritual scriptures, philosophical depth, and divine wisdom.'),
                            array('title' => 'Throat Chakra Activation', 'desc' => 'Purifies the throat center, aligning one’s speech with truth (Satya) and spiritual power.')
                        ),
                        'mental'        => array(
                            array('title' => 'Extraordinary Memory & Concentration', 'desc' => 'Sharpens analytical thinking, information retention, and laser-focused academic performance.'),
                            array('title' => 'Vocal Eloquence & Oratory Power', 'desc' => 'Eliminates stage fright, vocal hesitation, and stammering, granting persuasive and charming articulation.'),
                            array('title' => 'Creative Expansion', 'desc' => 'Unlocks blocked creative channels for artists, musicians, authors, and researchers.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Academic & Competitive Excellence', 'desc' => 'Highly recommended for students preparing for competitive exams or advanced scientific research.'),
                            array('title' => 'Communication & Negotiation Mastery', 'desc' => 'Empowers diplomats, lawyers, journalists, IT professionals, and corporate leaders to excel in dialogue.'),
                            array('title' => 'Mercury Planetary Shield', 'desc' => 'Pacifies Mercury retrograde or afflicted Budha in the birth chart, ensuring astute business judgment.')
                        ),
                        'health'        => array(
                            array('title' => 'Vocal Cord & Respiratory Health', 'desc' => 'Beneficial for vocal strain, sore throat, asthma, and chronic nasal/respiratory congestion.'),
                            array('title' => 'Nervous System & Thyroid Harmony', 'desc' => 'Assists in regulating thyroid function and stabilizing nerve impulses throughout the body.'),
                            array('title' => 'Cognitive Vitality', 'desc' => 'Combats mental exhaustion and brain fog during intense study or intellectual labor.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Wednesday morning or Monday morning before noon.',
                        'purification' => 'Bathe and wear clean attire. Offer white or yellow flowers to Lord Brahma or Shiva.',
                        'capping'      => 'Cap in Silver or Gold, strung with green, red, or silk thread.',
                        'chanting'     => 'Chant "AUM HREEM NAMAH" 108 times meditatively before wearing.'
                    )
                ),
                5 => array(
                    'number'         => 5,
                    'page_id'        => 1902,
                    'name'           => '5 Mukhi Rudraksha (Panch Mukhi)',
                    'title_tagline'  => 'The Universal Shield of Lord Kalagni Rudra',
                    'badge'          => 'Most Essential • Overall Wellbeing • Peace',
                    'deity'          => 'Lord Kalagni Rudra (Shiva\'s Five-Faced Form)',
                    'planet'         => 'Jupiter (Brihaspati)',
                    'mantra_sanskrit'=> 'Aum Hreem Namah',
                    'mantra_english' => 'AUM HREEM NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/yVeGueEP8sGQidqUt0a9DkijxjYbYEvCEw9e2Ysb.webp') : '/wp-content/uploads/rudraksha/yVeGueEP8sGQidqUt0a9DkijxjYbYEvCEw9e2Ysb.webp',
                    'overview'       => 'The 5 Mukhi Rudraksha is the most abundant and universally sacred bead blessed by Lord Kalagni Rudra, the five-faced aspect of Shiva who purifies the five elements (Earth, Water, Fire, Air, Ether) within the human body. It is the cornerstone of every Rudraksha mala and is traditionally worn by sages and householders alike.<br><br>Governed by the benevolent planet Jupiter (Brihaspati), the Panch Mukhi elevates divine grace, wisdom, moral character, and peace of mind. It burns away sins committed through forbidden acts and shields the physical body from sudden illness, negative environments, and psychic stress.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Purification of Five Elements', 'desc' => 'Harmonizes the Pancha Mahabhutas within the physical and subtle anatomy of the wearer.'),
                            array('title' => 'Awakening Higher Consciousness', 'desc' => 'Deepens devotion (Bhakti), spiritual discipline, and alignment with universal dharma.')
                        ),
                        'mental'        => array(
                            array('title' => 'Profound Inner Tranquility', 'desc' => 'Calms restless thoughts, alleviates chronic stress, and brings serene mental clarity.'),
                            array('title' => 'Optimism & Positive Outlook', 'desc' => 'Removes cynicism and melancholia, infusing the mind with Jupiterian hope and wisdom.'),
                            array('title' => 'Enhanced Awareness & Focus', 'desc' => 'Improves daily awareness and prevents impulsive or self-destructive behaviors.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Wisdom in Leadership & Decision Making', 'desc' => 'Attracts respect, honorable reputation, and ethical guidance in all financial pursuits.'),
                            array('title' => 'Brihaspati Kripa (Jupiter Blessings)', 'desc' => 'Removes obstacles related to education, teaching careers, legal matters, and spiritual mentorship.'),
                            array('title' => 'Universal Protection & Stability', 'desc' => 'Provides steady, grounded protection during travel, high-pressure projects, and life transitions.')
                        ),
                        'health'        => array(
                            array('title' => 'Blood Pressure & Heart Regulation', 'desc' => 'Renowned across Ayurveda for stabilizing systolic and diastolic blood pressure and soothing cardiac tension.'),
                            array('title' => 'Digestive & Liver Support', 'desc' => 'Promotes healthy liver function, metabolism, and relief from chronic acidity.'),
                            array('title' => 'Stress-Free Sleep', 'desc' => 'Helps overcome insomnia and restless sleep patterns when worn or placed near the pillow.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Thursday morning (Jupiter’s day) or Monday morning.',
                        'purification' => 'Bathe, wear clean clothes, and consecrate with milk and holy water at your altar.',
                        'capping'      => 'Can be strung as a full 108+1 mala or capped individually in Silver/Gold.',
                        'chanting'     => 'Chant "AUM HREEM NAMAH" or "OM NAMAH SHIVAYA" 108 times before wearing.'
                    )
                ),
                6 => array(
                    'number'         => 6,
                    'page_id'        => 1891,
                    'name'           => '6 Mukhi Rudraksha (Cheh Mukhi)',
                    'title_tagline'  => 'The Martial Grace & Wisdom of Lord Kartikeya',
                    'badge'          => 'Willpower • Focus • Grounded Charisma',
                    'deity'          => 'Lord Kartikeya / Murugan (Commander of Gods)',
                    'planet'         => 'Venus (Shukra) & Mars (Secondary)',
                    'chakra'         => 'Swadhisthana & Muladhara Chakra',
                    'mantra_sanskrit'=> 'Aum Hreem Hum Namah',
                    'mantra_english' => 'AUM HREEM HUM NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/rQ92HbTlhkmRTmPYwRfPA8SUFAsSv9O0K4TwD2wp.webp') : '/wp-content/uploads/rudraksha/rQ92HbTlhkmRTmPYwRfPA8SUFAsSv9O0K4TwD2wp.webp',
                    'overview'       => 'The 6 Mukhi Rudraksha is blessed by Lord Kartikeya (Murugan / Skanda), the six-headed warrior son of Lord Shiva and Goddess Parvati and the supreme commander of the celestial forces. It embodies fearless courage combined with supreme strategic wisdom and artistic grace.<br><br>Governed primarily by Venus (Shukra), this bead refines personal magnetism, attractiveness, and creative energy while channeling the disciplined determination of Murugan. It grounds chaotic emotional energies, anchoring the wearer in absolute focus, discipline, and victorious perseverance against competition.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Spiritual Grounding & Stability', 'desc' => 'Connects the lower chakras to Earth energy, ensuring spiritual seekers remain practical and balanced.'),
                            array('title' => 'Overcoming Inner Enemies', 'desc' => 'Conquers lust, anger, greed, and jealousy through divine self-mastery.')
                        ),
                        'mental'        => array(
                            array('title' => 'Laser-Sharp Willpower & Endurance', 'desc' => 'Eliminates mental fatigue, laziness, and distraction during demanding physical or mental tasks.'),
                            array('title' => 'Magnetic Charisma & Confidence', 'desc' => 'Enhances personal aura, charm, and grace in social, public, and intimate settings.'),
                            array('title' => 'Emotional Steadfastness', 'desc' => 'Provides immense emotional strength during times of crisis, grief, or personal transition.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Victory Over Rivals & Litigation', 'desc' => 'Empowers military personnel, police, athletes, executives, and legal professionals to triumph over opposition.'),
                            array('title' => 'Artistic & Luxury Abundance', 'desc' => 'Attracts Venusian blessings of comfort, luxury, artistic success, and material refinement.'),
                            array('title' => 'Property & Asset Stability', 'desc' => 'Assists in securing real estate, physical investments, and long-term financial security.')
                        ),
                        'health'        => array(
                            array('title' => 'Reproductive & Vitality Health', 'desc' => 'Traditionally beneficial for reproductive organs, urinary health, and hormonal balance.'),
                            array('title' => 'Musculoskeletal & Stamina Support', 'desc' => 'Strengthens stamina, muscle tone, and physical resilience.'),
                            array('title' => 'Throat & Vocal Relief', 'desc' => 'Soothes chronic throat irritation and supports nerve function.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Friday morning (for Venus) or Tuesday/Monday morning.',
                        'purification' => 'Bathe, wear clean clothes, and light pure incense before Lord Kartikeya or Shiva.',
                        'capping'      => 'Cap in Silver or Gold, strung on red or white silk thread.',
                        'chanting'     => 'Chant "AUM HREEM HUM NAMAH" 108 times with focus and devotion.'
                    )
                ),
                7 => array(
                    'number'         => 7,
                    'page_id'        => 1877,
                    'name'           => '7 Mukhi Rudraksha (Saat Mukhi)',
                    'title_tagline'  => 'The Infinite Prosperity of Goddess Mahalakshmi',
                    'badge'          => 'Wealth • Career Rise • Aura Shielding',
                    'deity'          => 'Goddess Mahalakshmi (Goddess of Wealth)',
                    'planet'         => 'Venus (Shukra) & Saturn (Shani)',
                    'chakra'         => 'Manipura (Solar Plexus Chakra)',
                    'mantra_sanskrit'=> 'Aum Hum Namah / Aum Mahalakshmi Namah',
                    'mantra_english' => 'AUM HUM NAMAH & AUM MAHALAKSHMI NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/k0WXQVj0B3kG3IW6t8CyRoDgBMvyfcHDp1ETCBcp.webp') : '/wp-content/uploads/rudraksha/k0WXQVj0B3kG3IW6t8CyRoDgBMvyfcHDp1ETCBcp.webp',
                    'overview'       => 'The 7 Mukhi Rudraksha bears seven natural vertical lines and is the direct embodiment of Goddess Mahalakshmi, the supreme ruler of wealth, fortune, grace, and abundance. It also carries the blessings of the seven divine sages (Saptarishi) and the seven cosmic mothers (Sapta Matrikas).<br><br>While showering the wearer with financial growth and material splendor, the 7 Mukhi also possesses the unique power to pacify the malefic effects of Saturn (Shani Dev) such as Sade Sati and Dhaiya. It dispels financial distress, unlocks hidden avenues of income, and ensures that wealth earned is accompanied by peace, health, and spiritual honor.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Mahalakshmi Kripa (Divine Grace)', 'desc' => 'Invites the permanent residence of divine opulence, purity, and spiritual fortune into one’s home and aura.'),
                            array('title' => 'Saturnian Karmic Shield', 'desc' => 'Nullifies the harsh karmic lessons and delays imposed by an unfavorable Saturn in the horoscope.')
                        ),
                        'mental'        => array(
                            array('title' => 'Relief from Financial Anxiety', 'desc' => 'Dissolves deep-rooted money worries, scarcity mindset, and stress concerning future security.'),
                            array('title' => 'Radiant Hope & Intuition', 'desc' => 'Awakens positive intuition for profitable investments and right livelihood decisions.'),
                            array('title' => 'Internal Dignity & Self-Worth', 'desc' => 'Instills a sovereign sense of self-respect and grace.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Exponential Financial Growth', 'desc' => 'Attracts new business opportunities, rapid promotions, salary leaps, and wealth accumulation.'),
                            array('title' => 'Business Recovery & Profitability', 'desc' => 'Revitalizes struggling businesses, resolving debt loops and financial stagnation.'),
                            array('title' => 'Success for Professionals & Traders', 'desc' => 'Highly auspicious for entrepreneurs, bankers, jewelers, stock traders, and corporate managers.')
                        ),
                        'health'        => array(
                            array('title' => 'Joint, Bone & Muscular Comfort', 'desc' => 'Relieves aches, arthritis stiffness, and physical fatigue associated with Saturn imbalances.'),
                            array('title' => 'Metabolic & Solar Plexus Harmony', 'desc' => 'Balances the stomach, liver, and digestive fire for healthy nutrient absorption.'),
                            array('title' => 'Nervous System Restoration', 'desc' => 'Soothes chronic exhaustion and restores physical vigor.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Friday morning (Lakshmi’s day) or Saturday morning (for Shani relief).',
                        'purification' => 'Bathe thoroughly and dress in clean clothes. Offer red or pink flowers to Goddess Lakshmi.',
                        'capping'      => 'Cap in Silver or Gold, or string with red silk thread.',
                        'chanting'     => 'Chant "AUM HUM NAMAH" and "AUM MAHALAKSHMI NAMAH" 108 times.'
                    )
                ),
                8 => array(
                    'number'         => 8,
                    'page_id'        => 1856,
                    'name'           => '8 Mukhi Rudraksha (Aath Mukhi)',
                    'title_tagline'  => 'The Obstacle Remover (Vighnaharta Lord Ganesha)',
                    'badge'          => 'Wisdom • Obstacle Removal • Ketu Shield',
                    'deity'          => 'Lord Ganesha (Vighnaharta)',
                    'planet'         => 'Ketu (Shadow Planet)',
                    'chakra'         => 'Muladhara (Root Chakra)',
                    'mantra_sanskrit'=> 'Aum Hum Namah / Om Ganeshaya Namah',
                    'mantra_english' => 'AUM HOOM NAMAH & OM GANESHAYE NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/Iyxx9YsDQmmdD0CgTmisbrmuZ1MuAzV9EsBbge4b.webp') : '/wp-content/uploads/rudraksha/Iyxx9YsDQmmdD0CgTmisbrmuZ1MuAzV9EsBbge4b.webp',
                    'overview'       => 'The 8 Mukhi Rudraksha is blessed by Lord Ganesha, the elephant-headed God of wisdom, intellect, and the absolute destroyer of obstacles (Vighnaharta). It also corresponds to the eight divine forms of Goddess Lakshmi (Ashtalakshmi) and the eight mountains of Vedic cosmology.<br><br>Governed by the mysterious shadow planet Ketu and rooted in the Muladhara chakra, the 8 Mukhi clears away hidden roadblocks, bureaucratic delays, and sudden setbacks. It transforms confusion into supreme analytical clarity, grounding the wearer in profound wisdom, stability, and uninterrupted progress in all life endeavors.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Root Chakra Awakening', 'desc' => 'Firmly anchors the subtle body, awakening the foundational spiritual energy of the Muladhara.'),
                            array('title' => 'Ketu Karmic Pacification', 'desc' => 'Shields against the unpredictable, disruptive, and confusing influences of malefic Ketu or Kaal Sarp Dosh.')
                        ),
                        'mental'        => array(
                            array('title' => 'Supreme Intellect & Problem Solving', 'desc' => 'Grants razor-sharp intellect, strategic foresight, and the ability to solve complex dilemmas effortlessly.'),
                            array('title' => 'Elimination of Fear & Paranoia', 'desc' => 'Dispels unfounded anxieties, superstitious dread, and mental restlessness.'),
                            array('title' => 'Unshakable Patience & Focus', 'desc' => 'Encourages methodical perseverance and calmness under extreme pressure.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Smooth Project Completion', 'desc' => 'Removes unexpected hurdles, legal hold-ups, and opposition in business contracts and ventures.'),
                            array('title' => 'Success in Writing & Analytical Fields', 'desc' => 'Highly auspicious for writers, auditors, scientists, astrologers, and researchers.'),
                            array('title' => 'Ashtalakshmi Blessings', 'desc' => 'Attracts eightfold abundance including success, health, knowledge, strength, and prosperity.')
                        ),
                        'health'        => array(
                            array('title' => 'Nervous & Leg Vitality', 'desc' => 'Traditionally supportive for lower spine, hip, leg, and bone strength.'),
                            array('title' => 'Respiratory & Sinus Comfort', 'desc' => 'Helps soothe chronic respiratory ailments, sinus congestion, and lethargy.'),
                            array('title' => 'Excretory System Regulation', 'desc' => 'Assists in healthy physical elimination and detoxification.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Wednesday morning (Ganesha’s day) or Monday before noon.',
                        'purification' => 'Bathe and wear clean attire. Offer Durva grass or yellow sweets to Lord Ganesha.',
                        'capping'      => 'Cap in Silver or Gold, strung on red or silk thread.',
                        'chanting'     => 'Chant "AUM HOOM NAMAH" and "OM GANESHAYE NAMAH" 108 times.'
                    )
                ),
                9 => array(
                    'number'         => 9,
                    'page_id'        => 1839,
                    'name'           => '9 Mukhi Rudraksha (Nau Mukhi)',
                    'title_tagline'  => 'The Invincible Shield of Navadurga & Shakti',
                    'badge'          => 'Supreme Protection • Fearlessness • Power',
                    'deity'          => 'Goddess Navadurga (Nine Forms of Durga)',
                    'planet'         => 'Rahu (North Lunar Node)',
                    'chakra'         => 'Sahasrara & Ajna Chakra',
                    'mantra_sanskrit'=> 'Aum Hreem Hum Namah',
                    'mantra_english' => 'AUM HREEM HOOM NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/AWJRfDwiFRQMEE5nDzxfnOdc5S29eCeAxqCHgbqT.webp') : '/wp-content/uploads/rudraksha/AWJRfDwiFRQMEE5nDzxfnOdc5S29eCeAxqCHgbqT.webp',
                    'overview'       => 'The 9 Mukhi Rudraksha carries nine natural lines and encapsulates the divine cosmic energy of the nine forms of Goddess Durga (Navadurga: Shailaputri, Brahmacharini, Chandraghanta, Kushmanda, Skandamata, Katyayani, Kaalratri, Mahagauri, and Siddhidatri). It is the ultimate bead of supreme feminine power (Shakti).<br><br>Ruling the shadow planet Rahu, this bead is an impenetrable armor against psychic attacks, black magic, ghosts, and sudden misfortunes. It burns away lethargy and fear, filling the wearer with dynamic courage, high energy, and the commanding presence of the Divine Mother.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Impenetrable Aura Armor', 'desc' => 'Constructs a blazing protective shield around the aura, blocking all lower astral entities and psychic manipulation.'),
                            array('title' => 'Shakti Awakening', 'desc' => 'Awakens dormant kundalini energy and connects the seeker directly to divine grace and intuition.')
                        ),
                        'mental'        => array(
                            array('title' => 'Absolute Fearlessness (Abhaya)', 'desc' => 'Destroys phobias, night terrors, panic attacks, and fear of enemies or death.'),
                            array('title' => 'High Dynamic Energy', 'desc' => 'Eliminates laziness, procrastination, and fatigue, replacing them with unstoppable willpower.'),
                            array('title' => 'Mental Sharpness & Clarity', 'desc' => 'Clears Rahu-induced confusion, hallucinations, and obsessive loops of negative thinking.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Triumph Over Competitors', 'desc' => 'Ensures victory in court cases, competitive markets, political endeavors, and high-stakes leadership.'),
                            array('title' => 'Career Breakthroughs', 'desc' => 'Overcomes sudden setbacks caused by Rahu eclipses or Kaal Sarp Dosh, paving the way for rapid advancement.'),
                            array('title' => 'Prestige & Honor', 'desc' => 'Commands deep respect and authority within society and professional circles.')
                        ),
                        'health'        => array(
                            array('title' => 'Nervous & Brain Protection', 'desc' => 'Supports neurological health, alleviating vertigo, unexplained dizziness, and chronic exhaustion.'),
                            array('title' => 'Adrenal & Vitality Support', 'desc' => 'Regulates energy levels and strengthens the immune response against sudden weaknesses.'),
                            array('title' => 'Skin & Cellular Harmony', 'desc' => 'Traditionally associated with soothing Rahu-related skin irritations and systemic stress.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Saturday morning (for Rahu/Durga) or Tuesday/Monday before noon.',
                        'purification' => 'Bathe and wear clean attire. Offer red hibiscus flowers or incense to Goddess Durga.',
                        'capping'      => 'Cap in Silver or Gold, strung on red silk or woolen thread.',
                        'chanting'     => 'Chant "AUM HREEM HOOM NAMAH" exactly 108 times with devotion.'
                    )
                ),
                10 => array(
                    'number'         => 10,
                    'page_id'        => 1970,
                    'name'           => '10 Mukhi Rudraksha (Das Mukhi)',
                    'title_tagline'  => 'The 10 Avatars of Lord Vishnu (Cosmic Shield)',
                    'badge'          => 'Total Protection • Peace • Legal Shield',
                    'deity'          => 'Lord Vishnu (The Preserver & All 10 Avatars)',
                    'planet'         => 'All Planets (Universal Pacifier)',
                    'chakra'         => 'Anahata (Heart Chakra)',
                    'mantra_sanskrit'=> 'Aum Hreem Namah',
                    'mantra_english' => 'AUM HREEM NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/gqWGLPpmK6sbxnlkvNhN6MbMaVYYimLeeljmXwm2.webp') : '/wp-content/uploads/rudraksha/gqWGLPpmK6sbxnlkvNhN6MbMaVYYimLeeljmXwm2.webp',
                    'overview'       => 'The 10 Mukhi Rudraksha features ten natural faces and represents Lord Maha Vishnu, the supreme preserver of the universe, along with His ten divine incarnations (Dashavatara: Matsya, Kurma, Varaha, Narasimha, Vamana, Parashurama, Rama, Krishna, Buddha, and Kalki). It is also blessed by Lord Yamaraj, the Lord of Justice.<br><br>As a unique bead that holds sovereignty over all nine planets, the 10 Mukhi acts as an absolute cosmic shield against malefic planetary transits, evil eyes, legal disputes, and psychic attacks. Resonating with the Heart Chakra (Anahata), it brings profound inner peace, emotional security, and righteous victory.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Dashavatara Cosmic Shield', 'desc' => 'Invokes the protective grace of all ten incarnations of Vishnu, guarding the soul in all ten directions of space.'),
                            array('title' => 'Universal Planetary Pacification', 'desc' => 'Neutralizes negative astrological influences across all nine planets simultaneously.')
                        ),
                        'mental'        => array(
                            array('title' => 'Profound Heart Tranquility', 'desc' => 'Opens and soothes the Heart Chakra, resolving emotional grief, insecurity, and anxiety.'),
                            array('title' => 'Freedom from Fear of Death or Evil', 'desc' => 'Dispels nightmares, fear of ghosts, and paranoia regarding untimely accidents or enemies.'),
                            array('title' => 'Righteous Judgment & Clarity', 'desc' => 'Instills moral courage, ethical clarity, and peaceful mental equilibrium under stress.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Victory in Legal & Court Battles', 'desc' => 'Renowned for protecting the wearer in litigation, disputes, and administrative conflicts.'),
                            array('title' => 'Career Protection & Stability', 'desc' => 'Prevents sudden job loss, betrayal by colleagues, and business fraud.'),
                            array('title' => 'Preservation of Wealth', 'desc' => 'Ensures hard-earned assets and family wealth are safeguarded from unexpected losses.')
                        ),
                        'health'        => array(
                            array('title' => 'Cardiovascular & Chest Health', 'desc' => 'Supports heart health, circulation, and relief from emotional chest tightness.'),
                            array('title' => 'Spine & Immune Resilience', 'desc' => 'Strengthens the spinal column and bolsters the immune system against environmental stress.'),
                            array('title' => 'Hearing & Nerve Calmness', 'desc' => 'Traditionally associated with soothing nerve tension and ear/hearing balance.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Sunday morning (Vishnu/Surya) or Monday morning before noon.',
                        'purification' => 'Bathe cleanly, dress in yellow or white clothes, and light a pure ghee lamp before Lord Vishnu.',
                        'capping'      => 'Best capped in Gold or Silver, strung on yellow, red, or silk thread.',
                        'chanting'     => 'Chant "AUM HREEM NAMAH" or "OM NAMO BHAGAVATE VASUDEVAYA" 108 times.'
                    )
                ),
                11 => array(
                    'number'         => 11,
                    'page_id'        => 1979,
                    'name'           => '11 Mukhi Rudraksha (Gyarah Mukhi)',
                    'title_tagline'  => 'The Ekadash Rudra & Lord Hanuman Mastery',
                    'badge'          => 'Supreme Courage • Eloquence • Meditation',
                    'deity'          => 'Ekadash Rudra (11 Forms of Shiva) & Lord Hanuman',
                    'planet'         => 'All Planets / Mars & Saturn Mastery',
                    'chakra'         => 'Vishuddha & Ajna Chakra',
                    'mantra_sanskrit'=> 'Aum Hreem Hum Namah',
                    'mantra_english' => 'AUM HREEM HOOM NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/1S2AcYZKRVwLvi1kr65mPmYAZ8lxk4a5LHe0FnZy.webp') : '/wp-content/uploads/rudraksha/1S2AcYZKRVwLvi1kr65mPmYAZ8lxk4a5LHe0FnZy.webp',
                    'overview'       => 'The 11 Mukhi Rudraksha exhibits eleven natural faces and represents the eleven Rudras (Ekadash Rudra), with Lord Hanuman being the eleventh and most dynamic Rudra avatar. It combines the supreme meditative stillness of Shiva with the unshakeable devotion, courage, and vitality of Hanuman.<br><br>Like the 10 Mukhi, this bead holds mastery over all planets, particularly harmonizing Mars and Saturn. It grants supreme oratorical skill, sharp intellectual judgment, physical stamina, and fearlessness. It is revered by yogis and leaders for awakening spiritual consciousness while ensuring worldly triumph.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Ekadash Rudra Spiritual Awakening', 'desc' => 'Bestows the spiritual merit of performing thousands of horse sacrifices (Ashwamedha Yajna) and giving sacred cows in charity.'),
                            array('title' => 'Hanuman Devotion & Aura Protection', 'desc' => 'Fills the aura with the invincible protective energy and pure devotion (Bhakti) of Lord Hanuman.')
                        ),
                        'mental'        => array(
                            array('title' => 'Unconquerable Courage & Will', 'desc' => 'Destroys self-doubt, hesitation, and fear of failure, instilling supreme mental fortitude.'),
                            array('title' => 'Wisdom & Oratorical Brilliance', 'desc' => 'Awakens the Throat and Third Eye chakras, granting charismatic speech and quick wit.'),
                            array('title' => 'Calmness During Crisis', 'desc' => 'Keeps the mind completely composed and strategic during emergencies and high-pressure situations.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'High Executive Leadership & Influence', 'desc' => 'Empowers diplomats, corporate executives, politicians, and public speakers to command authority.'),
                            array('title' => 'Overcoming All Rivals & Obstacles', 'desc' => 'Ensures success in negotiations, competitive exams, and career ambitions without ethical compromise.'),
                            array('title' => 'Protection from Accidental Losses', 'desc' => 'Shields investments and business ventures from sudden downturns.')
                        ),
                        'health'        => array(
                            array('title' => 'Immense Physical Stamina & Energy', 'desc' => 'Infuses the physical body with vital Prana, combating chronic fatigue and weakness.'),
                            array('title' => 'Nervous & Respiratory Fortitude', 'desc' => 'Supports lung capacity, nerve strength, and cellular vitality.'),
                            array('title' => 'Immune System Shielding', 'desc' => 'Traditionally valued for bolstering overall resistance to seasonal ailments.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Tuesday morning (Hanuman’s day) or Monday morning before noon.',
                        'purification' => 'Take a clean bath, wear light clothes, and light incense or oil lamp before Lord Hanuman or Shiva.',
                        'capping'      => 'Cap in Silver or Gold, strung on red silk or woolen thread.',
                        'chanting'     => 'Chant "AUM HREEM HOOM NAMAH" or "OM SRI HANUMATE NAMAH" 108 times.'
                    )
                ),
                12 => array(
                    'number'         => 12,
                    'page_id'        => 1990,
                    'name'           => '12 Mukhi Rudraksha (Barah Mukhi)',
                    'title_tagline'  => 'The Luminous Radiance of 12 Adityas (Surya Dev)',
                    'badge'          => 'Royal Brilliance • Executive Power • Vitality',
                    'deity'          => 'Lord Surya Dev (The 12 Adityas / Sun God)',
                    'planet'         => 'Sun (Surya)',
                    'chakra'         => 'Manipura (Solar Plexus) & Anahata Chakra',
                    'mantra_sanskrit'=> 'Aum Kraum Sraum Raum Namah / Sri Suryaya Namah',
                    'mantra_english' => 'AUM KRAUM SRAUM RAUM NAMAH & SRI SURYAYA NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/PM3OxqloigTQDyfDjBN7TK063Nfu1B7lHFJE6GNI.webp') : '/wp-content/uploads/rudraksha/PM3OxqloigTQDyfDjBN7TK063Nfu1B7lHFJE6GNI.webp',
                    'overview'       => 'The 12 Mukhi Rudraksha possesses twelve natural lines and is the direct manifestation of Lord Surya (The Sun God) and His twelve divine aspects (Dvadasa Adityas). Just as the rising sun dispels darkness, cold, and fog, the 12 Mukhi illuminates the wearer\'s life with royal brilliance, inner warmth, and clarity.<br><br>Governed by the Sun, this bead is the ultimate talisman for leaders, CEOs, politicians, administrators, and entrepreneurs. It removes self-doubt, lethargy, and the malefic effects of a weak Sun in the horoscope, bestowing magnetic leadership, physical vitality, and administrative sovereignty.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Surya Tejas (Divine Radiance)', 'desc' => 'Fills the subtle body with solar prana, illuminating the aura with golden spiritual light.'),
                            array('title' => 'Liberation from Low Frequencies', 'desc' => 'Burns away attachment to past regrets, gloom, and spiritual inertia.')
                        ),
                        'mental'        => array(
                            array('title' => 'Supreme Self-Reliance & Confidence', 'desc' => 'Instills a kingly sense of self-worth, motivation, and joyful optimism.'),
                            array('title' => 'Release from Stress & Worry', 'desc' => 'Dissolves mental burdens, anxiety, and fear of public speaking or judgment.'),
                            array('title' => 'Sharp Strategic Focus', 'desc' => 'Enhances organizational clarity, executive foresight, and willpower.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Sovereign Executive Authority', 'desc' => 'Commanding presence for top-level executives, ministers, business owners, and administrators.'),
                            array('title' => 'Fame, Honor & Recognition', 'desc' => 'Attracts prestige, awards, societal respect, and high professional reputation.'),
                            array('title' => 'Sun Planetary Remedies', 'desc' => 'Pacifies Surya Dosh, ensuring favorable relations with government authorities, superiors, and paternal figures.')
                        ),
                        'health'        => array(
                            array('title' => 'Digestive Fire & Metabolic Vitality', 'desc' => 'Stimulates the Solar Plexus, improving nutrient absorption and overall energy levels.'),
                            array('title' => 'Cardiac & Circulation Strength', 'desc' => 'Traditionally revered for supporting heart vitality, healthy circulation, and bone density.'),
                            array('title' => 'Eye & Skin Radiance', 'desc' => 'Associated with promoting clear eyesight, cellular rejuvenation, and healthy skin glow.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Sunday morning during sunrise.',
                        'purification' => 'Bathe at dawn, offer copper vessel water (Arghya) to the rising Sun while facing East.',
                        'capping'      => 'Cap in Gold or Silver, strung on red or orange silk/wool thread.',
                        'chanting'     => 'Chant "AUM KRAUM SRAUM RAUM NAMAH" or "SRI SURYAYA NAMAH" 108 times.'
                    )
                ),
                13 => array(
                    'number'         => 13,
                    'page_id'        => 1987,
                    'name'           => '13 Mukhi Rudraksha (Terah Mukhi)',
                    'title_tagline'  => 'The Divine Charisma of Lord Kamadeva & Indra',
                    'badge'          => 'Attraction • Luxury • Marital Bliss • Charm',
                    'deity'          => 'Lord Kamadeva (God of Love) & Lord Indra',
                    'planet'         => 'Venus (Shukra) & Moon (Chandra)',
                    'chakra'         => 'Swadhisthana & Vishuddha Chakra',
                    'mantra_sanskrit'=> 'Aum Hreem Namah / Om Kleem Kamadevaya Namah',
                    'mantra_english' => 'AUM HREEM NAMAH & OM KLEEM KAMADEVAYA NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/KbyOPJqfddYwORrEQ1ywmhMNJ5TRFbMzGmTNeGGS.webp') : '/wp-content/uploads/rudraksha/KbyOPJqfddYwORrEQ1ywmhMNJ5TRFbMzGmTNeGGS.webp',
                    'overview'       => 'The 13 Mukhi Rudraksha carries thirteen vertical lines and is blessed by Lord Kamadeva, the celestial deity of love, attraction, and desire, along with Lord Indra, the king of the heavens. It is the supreme bead for personal magnetism, hypnotic charm, and material luxury.<br><br>Co-ruled by Venus and the Moon, the 13 Mukhi showers the wearer with magnetic presence, artistic brilliance, emotional fulfillment, and harmonious romance. It fulfills worldly desires while awakening Kundalini grace, making the wearer irresistibly charming, eloquent, and successful in social and intimate circles.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Kundalini & Siddhi Awakening', 'desc' => 'Harmonizes sensory desires with higher spiritual consciousness, aiding in meditative absorption.'),
                            array('title' => 'Divine Magnetic Aura', 'desc' => 'Infuses the energetic field with pure attraction, warmth, and spiritual sweetness.')
                        ),
                        'mental'        => array(
                            array('title' => 'Irresistible Personal Charm & Wit', 'desc' => 'Enhances social intelligence, humor, warmth, and magnetic communication skills.'),
                            array('title' => 'Elimination of Social Anxiety', 'desc' => 'Removes shyness, awkwardness, and self-doubt in social, romantic, or public gatherings.'),
                            array('title' => 'Deep Emotional Contentment', 'desc' => 'Fills the heart with joy, romantic appreciation, and zest for life.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Success in Arts, Media & Public Relations', 'desc' => 'Highly auspicious for actors, musicians, marketers, politicians, and relationship counselors.'),
                            array('title' => 'Marital & Romantic Fulfillment', 'desc' => 'Attracts genuine soulmate connections and restores passion and harmony to married life.'),
                            array('title' => 'Indra’s Abundance', 'desc' => 'Attracts celestial comforts, luxury vehicles, fine properties, and high social standing.')
                        ),
                        'health'        => array(
                            array('title' => 'Reproductive & Hormonal Harmony', 'desc' => 'Traditionally associated with supporting reproductive vitality, libido, and hormonal equilibrium.'),
                            array('title' => 'Urinary & Kidney Support', 'desc' => 'Soothes fluid retention and supports healthy kidney function.'),
                            array('title' => 'Radiant Youthful Energy', 'desc' => 'Promotes glowing skin, physical vitality, and overall constitutional vigor.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Friday morning (Venus) or Monday morning before noon.',
                        'purification' => 'Bathe thoroughly and wear clean, bright clothes. Offer fragrant pink/white flowers and rose water at the altar.',
                        'capping'      => 'Cap in Silver or Gold, strung on red or silk thread.',
                        'chanting'     => 'Chant "AUM HREEM NAMAH" and "OM KLEEM KAMADEVAYA NAMAH" 108 times.'
                    )
                ),
                14 => array(
                    'number'         => 14,
                    'page_id'        => 2001,
                    'name'           => '14 Mukhi Rudraksha (Chaudah Mukhi - Deva Mani)',
                    'title_tagline'  => 'The Deva Mani (Divine Jewel of Lord Hanuman & Shiva)',
                    'badge'          => 'Supreme Intuition • Third Eye Awakening • Saturn Shield',
                    'deity'          => 'Lord Hanuman (Supreme Rudra) & Lord Paramashiva',
                    'planet'         => 'Saturn (Shani) & Mars (Mangal)',
                    'chakra'         => 'Ajna (Third Eye Chakra)',
                    'mantra_sanskrit'=> 'Aum Namah Sivaya / Aum Hreem Namah',
                    'mantra_english' => 'AUM NAMAH SIVAYA & AUM HREEM NAMAH',
                    'image_fallback' => function_exists('home_url') ? home_url('/wp-content/uploads/rudraksha/JjFsLrAPpEB5NBNPlRCMAWALDiHyscQZJodXwye5.webp') : '/wp-content/uploads/rudraksha/JjFsLrAPpEB5NBNPlRCMAWALDiHyscQZJodXwye5.webp',
                    'overview'       => 'The 14 Mukhi Rudraksha, revered across ancient scriptures as the "Deva Mani" (Divine Jewel), is the most precious and spiritually transcendent bead next to the 1 Mukhi. Born directly from the third eye tears of Lord Shiva and fully energized by Lord Hanuman, it is the supreme awakener of intuition and foresight.<br><br>Placed on the forehead or worn on the chest, the 14 Mukhi activates the Ajna (Third Eye) chakra, granting prophetic insight, clairvoyance, and absolute mastery over fear. It provides the most powerful known protection against the harsh malefic transits of Saturn (Sade Sati, Dhaiya, Shani Dosh) and Mars, guiding the wearer to peak spiritual liberation and worldly sovereignty.',
                    'benefits'       => array(
                        'spiritual'     => array(
                            array('title' => 'Third Eye (Ajna Chakra) Activation', 'desc' => 'Awakens deep intuition, prophetic dreams, clairvoyance, and direct spiritual vision.'),
                            array('title' => 'The Deva Mani Spiritual Sovereignty', 'desc' => 'Elevates the soul above mundane attachments while granting supreme protection from all lower astral forces.'),
                            array('title' => 'Absolute Karmic Shielding', 'desc' => 'Neutralizes karmic debts and provides direct communion with Lord Shiva and Hanuman.')
                        ),
                        'mental'        => array(
                            array('title' => 'Infallible Decision Making & Foresight', 'desc' => 'Empowers the wearer to foresee potential dangers or opportunities before they manifest.'),
                            array('title' => 'Absolute Courage & Will of Hanuman', 'desc' => 'Instills unyielding emotional resilience, supreme bravery, and mental calmness.'),
                            array('title' => 'Release from Paranoia & Trauma', 'desc' => 'Completely destroys past trauma, phobias, and deep-seated anxieties.')
                        ),
                        'career_wealth' => array(
                            array('title' => 'Supreme Saturn & Mars Pacification', 'desc' => 'The ultimate Vedic remedy for Sade Sati, Shani Mahadasha, and Mangalik obstacles, turning hardships into rapid success.'),
                            array('title' => 'Top Executive & Speculative Success', 'desc' => 'Invaluable for stock investors, land developers, surgeons, judges, and top decision-makers.'),
                            array('title' => 'Unshakeable Status & Fortune', 'desc' => 'Secures permanent wealth, high societal honor, and protection against conspiracy or sudden loss.')
                        ),
                        'health'        => array(
                            array('title' => 'Neurological & Third Eye Harmony', 'desc' => 'Supports pineal and pituitary gland balance, soothing chronic migraines and mental fatigue.'),
                            array('title' => 'Musculoskeletal & Spinal Vigor', 'desc' => 'Assists in overall skeletal strength, joint resilience, and physical endurance.'),
                            array('title' => 'Cellular Pranic Rejuvenation', 'desc' => 'Promotes rapid recovery from physical exhaustion and bolsters vital energy.')
                        )
                    ),
                    'wearing_ritual' => array(
                        'day_time'     => 'Tuesday morning (Hanuman) or Saturday morning (Shani) / Monday before noon.',
                        'purification' => 'Bathe cleanly, wear fresh clothes, and touch the bead to your forehead/Third Eye before the altar.',
                        'capping'      => 'Must be capped with high purity Silver or Gold, worn on the chest or forehead (during meditation).',
                        'chanting'     => 'Chant "AUM NAMAH SIVAYA" and "AUM HREEM NAMAH" 108 times with profound concentration.'
                    )
                )
            );
        }

        /**
         * Resolves the exact WooCommerce product link, price, and image for a given Mukhi number.
         *
         * @param int $mukhi Mukhi number (1 to 14).
         * @return array Array with keys: 'id', 'url', 'price_html', 'image_url', 'is_real_product'
         */
        public static function resolve_product( $mukhi ) {
            $mukhi = intval( $mukhi );
            if ( $mukhi < 1 || $mukhi > 14 ) {
                $mukhi = 1;
            }

            $all_data = self::get_all();
            $data     = isset( $all_data[ $mukhi ] ) ? $all_data[ $mukhi ] : $all_data[1];

            $result = array(
                'id'              => 0,
                'url'             => home_url( '/shop/?s=' . $mukhi . '+Mukhi+Rudraksha' ),
                'price_html'      => '<span class="rudraksha-price-tag">Authentic Vedic Consecrated Bead</span>',
                'image_url'       => $data['image_fallback'],
                'is_real_product' => false,
                'title'           => $data['name']
            );

            if ( function_exists( 'wc_get_products' ) ) {
                // Fetch all published products to guarantee exact Mukhi match via get_mukhi_by_page_id
                $products = wc_get_products( array(
                    'status' => 'publish',
                    'limit'  => -1,
                ) );

                if ( ! empty( $products ) ) {
                    foreach ( $products as $product ) {
                        $matched_mukhi = self::get_mukhi_by_page_id( $product->get_id() );
                        if ( $matched_mukhi === $mukhi ) {
                            $result['id']              = $product->get_id();
                            $result['url']             = $product->get_permalink();
                            $result['price_html']      = $product->get_price_html() ? $product->get_price_html() : '<span class="rudraksha-price-tag">Authentic Vedic Consecrated Bead</span>';
                            $img_id                    = $product->get_image_id();
                            if ( $img_id ) {
                                $img_src = wp_get_attachment_image_url( $img_id, 'large' );
                                if ( $img_src ) {
                                    $result['image_url'] = $img_src;
                                }
                            }
                            $result['is_real_product'] = true;
                            $result['title']           = $product->get_name();
                            break;
                        }
                    }
                }
            }

            return $result;
        }

        /**
         * Get resolved WooCommerce products for all 14 Mukhis.
         *
         * @return array Array of products keyed by mukhi number.
         */
        public static function get_all_products() {
            $all_products = array();
            for ( $i = 1; $i <= 14; $i++ ) {
                $all_products[ $i ] = self::resolve_product( $i );
            }
            return $all_products;
        }

        /**
         * Returns Mukhi number by Page ID, post slug, post title, or request URI. If no match, returns 0.
         *
         * @param int $page_id
         * @return int
         */
        public static function get_mukhi_by_page_id( $page_id = 0 ) {
            $page_id = intval( $page_id );
            $all     = self::get_all();

            // 1. Check exact page_id match from known IDs
            foreach ( $all as $num => $data ) {
                if ( intval( $data['page_id'] ) === $page_id && $page_id > 0 ) {
                    return intval( $num );
                }
            }

            // 2. Resolve post object (by $page_id or global $post or get_queried_object)
            $post = null;
            if ( $page_id > 0 && function_exists( 'get_post' ) ) {
                $post = get_post( $page_id );
            }
            if ( ! $post && function_exists( 'get_queried_object' ) ) {
                $queried = get_queried_object();
                if ( isset( $queried->post_title ) || isset( $queried->post_name ) ) {
                    $post = $queried;
                }
            }
            if ( ! $post && isset( $GLOBALS['post'] ) && is_object( $GLOBALS['post'] ) ) {
                $post = $GLOBALS['post'];
            }

            // Collect text strings to search (slug, title, and request URI)
            $search_strings = array();
            if ( $post && isset( $post->post_name ) && ! empty( $post->post_name ) ) {
                $search_strings[] = strtolower( $post->post_name );
            }
            if ( $post && isset( $post->post_title ) && ! empty( $post->post_title ) ) {
                $search_strings[] = strtolower( $post->post_title );
            }
            if ( isset( $_SERVER['REQUEST_URI'] ) && $page_id <= 0 ) {
                // Exclude /shop/, /cart/, /checkout/, /wp-admin/, post_type=product from general URL matching
                $uri = strtolower( $_SERVER['REQUEST_URI'] );
                if ( strpos( $uri, '/shop/' ) === false && strpos( $uri, '/cart/' ) === false && strpos( $uri, '/checkout/' ) === false && strpos( $uri, '/wp-admin/' ) === false && strpos( $uri, 'post_type=product' ) === false ) {
                    $search_strings[] = urldecode( $uri );
                }
            }

            // Map of patterns for each Mukhi 1 to 21 + Gauri Shankar + Trijuti
            $patterns = array(
                1  => '/\b(1|one|ek)\b.*mukhi|one-mukhi|1-mukhi|ek-mukhi/i',
                2  => '/\b(2|two|do)\b.*mukhi|two-mukhi|2-mukhi|do-mukhi/i',
                3  => '/\b(3|three|teen)\b.*mukhi|three-mukhi|3-mukhi|teen-mukhi/i',
                4  => '/\b(4|four|chaar|char)\b.*mukhi|four-mukhi|4-mukhi|chaar-mukhi/i',
                5  => '/\b(5|five|panch)\b.*mukhi|five-mukhi|5-mukhi|panch-mukhi/i',
                6  => '/\b(6|six|cheh|chah)\b.*mukhi|six-mukhi|6-mukhi|cheh-mukhi/i',
                7  => '/\b(7|seven|saat|sat)\b.*mukhi|seven-mukhi|7-mukhi|saat-mukhi/i',
                8  => '/\b(8|eight|aath|ath)\b.*mukhi|eight-mukhi|8-mukhi|aath-mukhi/i',
                9  => '/\b(9|nine|nau)\b.*mukhi|nine-mukhi|9-mukhi|nau-mukhi/i',
                10 => '/\b(10|ten|das)\b.*mukhi|ten-mukhi|10-mukhi|das-mukhi/i',
                11 => '/\b(11|eleven|gyarah|gyara)\b.*mukhi|eleven-mukhi|11-mukhi|gyarah-mukhi/i',
                12 => '/\b(12|twelve|barah|bara)\b.*mukhi|twelve-mukhi|12-mukhi|barah-mukhi/i',
                13 => '/\b(13|thirteen|terah|tera)\b.*mukhi|thirteen-mukhi|13-mukhi|terah-mukhi/i',
                14 => '/\b(14|fourteen|chaudah|chauda)\b.*mukhi|fourteen-mukhi|14-mukhi|chaudah-mukhi/i',
                15 => '/\b(15|fifteen|pandrah)\b.*mukhi|fifteen-mukhi|15-mukhi/i',
                16 => '/\b(16|sixteen|solah)\b.*mukhi|sixteen-mukhi|16-mukhi/i',
                17 => '/\b(17|seventeen|satrah)\b.*mukhi|seventeen-mukhi|17-mukhi/i',
                18 => '/\b(18|eighteen|atharah)\b.*mukhi|eighteen-mukhi|18-mukhi/i',
                19 => '/\b(19|nineteen|unnis)\b.*mukhi|nineteen-mukhi|19-mukhi/i',
                20 => '/\b(20|twenty|bis)\b.*mukhi|twenty-mukhi|20-mukhi/i',
                21 => '/\b(21|twenty-one|ikkis)\b.*mukhi|twenty-one-mukhi|21-mukhi/i',
                22 => '/gauri[- ]?shankar/i',
                23 => '/trijuti/i',
            );

            foreach ( $search_strings as $text ) {
                foreach ( $patterns as $num => $regex ) {
                    if ( preg_match( $regex, $text ) ) {
                        return $num;
                    }
                }
            }

            return 0;
        }
    }
}
