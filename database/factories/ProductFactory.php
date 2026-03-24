<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Factory responsible for generating fake data for Products
 */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            // Keyboards
            ['name' => 'Logitech G Pro X TKL', 'price' => 149, 'image' => 'Logitech G Pro X TKL.jpg', 'description' => 'Tournament-grade tenkeyless mechanical keyboard from Logitech featuring hot-swappable GX switches and LIGHTSYNC RGB. Built with a detachable USB-C cable, onboard memory for up to 5 profiles, and a compact design favored by esports professionals. Compatible with Logitech G HUB for advanced macro programming and lighting customization.'],
            ['name' => 'Razer BlackWidow V4', 'price' => 169, 'image' => 'Razer BlackWidow V4.jpg', 'description' => 'Full-size mechanical gaming keyboard powered by Razer Green mechanical switches with tactile and clicky feedback. Features per-key Razer Chroma RGB lighting with 16.8 million color options, a magnetic plush wrist rest, dedicated media keys with a multi-function roller, and doubleshot ABS keycaps for fade-resistant legends.'],
            ['name' => 'Corsair K100 RGB', 'price' => 229, 'image' => 'Corsair K100 RGB.webp', 'description' => 'Flagship mechanical keyboard from Corsair equipped with OPX optical-mechanical switches for lightning-fast 1.0mm actuation. Includes an iCUE control wheel for dynamic macro and media control, 44-zone LightEdge RGB, PBT double-shot keycaps, and 4MB onboard storage. Built with an aircraft-grade aluminum frame for premium durability.'],

            // Mice
            ['name' => 'Logitech G502 X Plus', 'price' => 159, 'image' => 'Logitech G502 X Plus.webp', 'description' => 'Wireless gaming mouse featuring the HERO 25K sensor with sub-micron precision tracking up to 25,600 DPI. Equipped with LIGHTFORCE hybrid optical-mechanical switches, LIGHTSPEED wireless technology, and a rechargeable battery lasting up to 130 hours. Includes adjustable weight system and 13 programmable controls for complete customization.'],
            ['name' => 'Razer DeathAdder V3 Pro', 'price' => 149, 'image' => 'Razer DeathAdder V3 Pro.jpg', 'description' => 'Ultra-lightweight ergonomic wireless gaming mouse weighing just 63 grams. Built with Razer Focus Pro 30K optical sensor, Razer HyperSpeed wireless technology for competition-level latency, and gen-3 optical switches rated for 90 million clicks. Features up to 90 hours of battery life on a single charge.'],
            ['name' => 'SteelSeries Rival 650', 'price' => 119, 'image' => 'SteelSeries Rival 650.jpg', 'description' => 'Dual-sensor wireless gaming mouse from SteelSeries with TrueMove3+ tracking at 12,000 CPI and a dedicated depth sensor for accurate lift-off detection. Features a customizable weight system with 8 removable weights, rapid charging via USB-C delivering 10 hours of use in 15 minutes, and 24-hour total battery life.'],

            // Monitors
            ['name' => 'Samsung Odyssey G7 32', 'price' => 599, 'image' => 'Samsung Odyssey G7 32.webp', 'description' => 'Curved 32-inch QHD gaming monitor from Samsung with a 1000R curvature and 240Hz refresh rate for ultra-smooth gameplay. Powered by a VA panel delivering deep blacks with a 2500:1 contrast ratio, 1ms GTG response time, and NVIDIA G-Sync and AMD FreeSync Premium Pro compatibility. Includes HDR600 certification and Samsung CoreSync ambient lighting.'],
            ['name' => 'LG UltraGear 27GP850-B', 'price' => 449, 'image' => 'LG UltraGear 27GP850-B.webp', 'description' => '27-inch QHD Nano IPS gaming monitor from LG with a 165Hz refresh rate overclockable to 180Hz. Delivers 98% DCI-P3 color coverage and 1ms GTG response time. Certified NVIDIA G-Sync Compatible and AMD FreeSync Premium with VESA DisplayHDR 400 support. Features a 3-side virtually borderless design and tilt, height, pivot adjustable stand.'],
            ['name' => 'ASUS ROG Swift PG279QM', 'price' => 799, 'image' => 'ASUS ROG Swift PG279QM.png', 'description' => '27-inch QHD IPS gaming monitor from ASUS overclockable to 240Hz for competitive gaming. Features NVIDIA G-Sync with Reflex Analyzer built-in to measure system latency in real time. Covers 95% DCI-P3 color gamut with VESA DisplayHDR 400. Includes ASUS Aura Sync RGB lighting on the back and an ergonomic stand with full adjustment range.'],

            // Headsets
            ['name' => 'SteelSeries Arctis Nova Pro', 'price' => 349, 'image' => 'SteelSeries Arctis Nova Pro.webp', 'description' => 'Premium wireless gaming headset from SteelSeries featuring active noise cancellation with 4 microphones and 360-degree spatial audio. Powered by custom-tuned 40mm planar magnetic drivers for audiophile-grade sound. Includes the GameDAC Gen 2 with OLED display, dual-battery system for infinite battery life with hot-swap, and retractable ClearCast Gen 2 AI-powered noise-cancelling microphone.'],
            ['name' => 'HyperX Cloud III Wireless', 'price' => 149, 'image' => 'HyperX Cloud III Wireless.webp', 'description' => 'Wireless gaming headset from HyperX with 53mm angled drivers delivering immersive DTS Headphone:X spatial audio. Features up to 120 hours of battery life, a durable aluminum frame, memory foam ear cushions with breathable leatherette, and a detachable noise-cancelling microphone. Compatible with PC, PS5, PS4, and Nintendo Switch via 2.4GHz wireless.'],
            ['name' => 'Sony WH-1000XM5', 'price' => 349, 'image' => 'Sony WH-1000XM5.avif', 'description' => 'Industry-leading wireless noise-cancelling headphones from Sony with eight microphones and two processors for unprecedented noise cancellation. Features 30mm custom drivers with crystal-clear audio, 30-hour battery life with quick charging, multipoint Bluetooth connection, and speak-to-chat automatic pause. Ultra-lightweight design at 250 grams with premium soft-fit leather headband.'],

            // Laptops
            ['name' => 'ASUS ROG Zephyrus G14', 'price' => 1599, 'image' => 'ASUS ROG Zephyrus G14.webp', 'description' => 'Compact 14-inch gaming laptop from ASUS powered by AMD Ryzen 9 processor and NVIDIA GeForce RTX 4060 GPU. Features a 2560x1600 IPS display at 165Hz with Dolby Vision, 16GB DDR5 RAM, 1TB PCIe 4.0 SSD, and a 76Wh battery lasting up to 10 hours. The AniMe Matrix LED display on the lid allows custom animations and notifications.'],
            ['name' => 'Apple MacBook Air M3', 'price' => 1299, 'image' => 'Apple MacBook Air M3.webp', 'description' => 'Ultra-thin laptop from Apple powered by the M3 chip with 8-core CPU and 10-core GPU. Features a stunning 15.3-inch Liquid Retina display with 500 nits brightness and P3 wide color, 16GB unified memory, 512GB SSD, and up to 18 hours of battery life. Weighs just 3.3 pounds with a fanless silent design and supports up to two external displays.'],
            ['name' => 'Lenovo Legion Pro 5', 'price' => 1449, 'image' => 'Lenovo Legion Pro 5.webp', 'description' => '16-inch gaming laptop from Lenovo powered by AMD Ryzen 7 and NVIDIA GeForce RTX 4070 with 140W TGP. Features a 2560x1600 IPS display at 240Hz with 100% sRGB, 32GB DDR5 RAM, 1TB SSD, and Lenovo Legion ColdFront 5.0 thermal system with dual fans and quad exhaust vents. Includes a per-key RGB keyboard and Nahimic audio for immersive gaming.'],

            // Webcams
            ['name' => 'Logitech Brio 4K Pro', 'price' => 199, 'image' => 'Logitech Brio 4K Pro.webp', 'description' => '4K Ultra HD webcam from Logitech with HDR and RightLight 3 auto-adjusting technology for perfect exposure in any lighting condition. Features a 90-degree field of view, 5x digital zoom, dual omnidirectional microphones, and infrared sensor for Windows Hello facial recognition. Compatible with all major video conferencing and streaming platforms.'],
            ['name' => 'Elgato Facecam Pro', 'price' => 299, 'image' => 'Elgato Facecam Pro.webp', 'description' => 'Professional 4K60 streaming webcam from Elgato with a Sony STARVIS sensor for exceptional low-light performance. Features an all-glass Elgato Prime Lens with adjustable field of view from 90 to 68 degrees, uncompressed video output via USB 3.0, and advanced ISP for true-to-life colors. Fully customizable through the Elgato Camera Hub software.'],
            ['name' => 'Razer Kiyo Pro Ultra', 'price' => 299, 'image' => 'Razer Kiyo Pro Ultra.webp', 'description' => 'Professional streaming webcam from Razer with a large 1/1.2-inch Sony Starvis 2 sensor for exceptional low-light performance. Captures uncompressed 4K 30fps video with automatic HDR and AI-powered face tracking for sharp focus. Features an adjustable field of view, built-in privacy shutter, and L-shaped desk mount for flexible positioning.'],

            // Storage
            ['name' => 'Samsung 990 Pro 2TB', 'price' => 189, 'image' => 'Samsung 990 Pro 2TB.webp', 'description' => 'High-performance 2TB NVMe M.2 SSD from Samsung with PCIe 4.0 delivering sequential read speeds of 7,450 MB/s and write speeds of 6,900 MB/s. Features Samsung V-NAND and a proprietary controller with nickel-coated heat spreader for optimal thermal management. Ideal for gaming, 4K video editing, and heavy multitasking workloads.'],
            ['name' => 'WD Black SN850X 1TB', 'price' => 109, 'image' => 'WD Black SN850X 1TB.webp', 'description' => '1TB NVMe SSD from Western Digital designed for gaming with up to 7,300 MB/s sequential read speed on PCIe Gen 4. Features Game Mode 2.0 that predicts and accelerates game asset loading, a predictive caching algorithm, and an optional heatsink for PS5 compatibility. Backed by a 5-year limited warranty and 600 TBW endurance rating.'],
            ['name' => 'Crucial T700 2TB', 'price' => 249, 'image' => 'Crucial T700 2TB.webp', 'description' => '2TB NVMe M.2 SSD from Crucial powered by PCIe 5.0 technology delivering sequential read speeds up to 12,400 MB/s and write speeds up to 11,800 MB/s. Features a Phison E26 controller paired with 232-layer Micron NAND for extreme performance. Includes an integrated aluminum heatsink and is backed by a 5-year limited warranty with 1200 TBW endurance.'],

            // Audio
            ['name' => 'Blue Yeti X', 'price' => 139, 'image' => 'Blue Yeti X.webp', 'description' => 'Professional USB condenser microphone from Blue with four selectable polar patterns: cardioid, omnidirectional, bidirectional, and stereo. Features a high-resolution LED metering display for real-time monitoring, Blue VO!CE software for advanced vocal effects, and a 48kHz/24-bit recording resolution. Built with a no-latency headphone output and multi-function smart knob.'],
            ['name' => 'Sony WF-1000XM5', 'price' => 279, 'image' => 'Sony WF-1000XM5.jpg', 'description' => 'Premium true wireless earbuds from Sony with industry-leading noise cancellation powered by the Integrated Processor V2 and QN2e chip. Features Dynamic Driver X for exceptional bass and crystal-clear highs, LDAC codec support for Hi-Res Audio wireless, and up to 24 hours of total battery life with the compact charging case. IPX4 water-resistant with Speak-to-Chat and Adaptive Sound Control.'],
            ['name' => 'Rode NT-USB Mini', 'price' => 99, 'image' => 'Rode NT-USB Mini.webp', 'description' => 'Compact studio-quality USB condenser microphone from Rode with a flat frequency response and low self-noise for pristine voice recordings. Features a built-in pop filter, integrated headphone output with zero-latency monitoring, and a magnetic desk stand with 360-degree rotation. Plug-and-play compatible with PC, Mac, iPad, and PlayStation.'],

            // Controllers
            ['name' => 'Xbox Elite Series 2 Core', 'price' => 129, 'image' => 'Xbox Elite Series 2 Core.webp', 'description' => 'Premium wireless controller from Microsoft with adjustable-tension thumbsticks, wrap-around rubberized grip, and shorter hair trigger locks for rapid firing. Features up to 40 hours of rechargeable battery life, Bluetooth and Xbox Wireless connectivity, and fully remappable buttons via the Xbox Accessories app. Compatible with Xbox Series X|S, Xbox One, PC, and mobile devices.'],
            ['name' => 'Sony DualSense Edge', 'price' => 199, 'image' => 'Sony DualSense Edge.webp', 'description' => 'Customizable wireless controller from Sony designed for PS5 with swappable stick caps and back buttons. Features adjustable trigger lengths and dead zones, remappable button profiles stored on-device, and a braided USB-C cable with connector housing for secure competitive play. Includes a carrying case and multiple stick cap and back button options in the box.'],
            ['name' => '8BitDo Ultimate 2.4G', 'price' => 69, 'image' => '8BitDo Ultimate 2.4G.webp', 'description' => 'Wireless gaming controller from 8BitDo with Hall Effect joysticks for zero stick drift and extreme precision. Features a charging dock, custom button mapping via the 8BitDo Ultimate Software, dual rumble motors, and two programmable back paddles. Connects via 2.4GHz wireless or Bluetooth and is compatible with PC, Android, and Nintendo Switch.'],

            // Accessories
            ['name' => 'Elgato Stream Deck MK.2', 'price' => 149, 'image' => 'Elgato Stream Deck MK.2.webp', 'description' => 'Customizable LCD keypad from Elgato with 15 programmable keys featuring dynamic icons that adapt to your actions. Control OBS, Twitch, Spotify, Philips Hue, and hundreds more with one tap. Features hot-swappable faceplates, a detachable USB-C cable, and adjustable stand. Create multi-action macros and organize commands into nested folders for unlimited control.'],
            ['name' => 'CalDigit TS4 Thunderbolt 4 Dock', 'price' => 379, 'image' => 'CalDigit TS4 Thunderbolt 4 Dock.jpg', 'description' => 'Professional Thunderbolt 4 docking station from CalDigit with 18 ports including three Thunderbolt 4 downstream, five USB-A, USB-C, DisplayPort 1.4, SD and microSD UHS-II card readers, 2.5 Gigabit Ethernet, and front audio combo jack. Delivers 98W charging to host laptop and supports dual 4K at 60Hz or single 8K display output.'],
            ['name' => 'Secretlab Titan Evo 2022', 'price' => 519, 'image' => 'Secretlab Titan Evo 2022.jpg', 'description' => 'Premium ergonomic gaming chair from Secretlab with a pebble seat base for extended sitting comfort. Features an integrated 4-way L-ADAPT lumbar support system, magnetic memory foam head pillow, full-metal 4D armrests with CloudSwap technology, and a multi-tilt mechanism with lock. Built with a steel frame supporting up to 285 lbs and available in NEO Hybrid Leatherette, SoftWeave Plus fabric, or NAPA leather.'],
        ];

        $product = fake()->unique()->randomElement($products);

        return [
            'name' => $product['name'],
            'description' => $product['description'],
            'price' => $product['price'],
            'stock' => fake()->numberBetween(10, 100),
            'image' => $product['image'],
        ];
    }
}
