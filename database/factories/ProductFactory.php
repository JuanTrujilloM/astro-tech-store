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
            ['name' => 'Stellar Mechanical Keyboard', 'description' => 'Premium mechanical keyboard featuring Cherry MX switches for precise and responsive keystrokes. Equipped with full RGB backlighting, customizable macros, and a durable aluminum frame built to withstand years of heavy use. Perfect for both competitive gaming and productive typing sessions.'],
            ['name' => 'Nebula Wireless Mouse', 'description' => 'Ergonomic wireless mouse engineered with a 16000 DPI optical sensor for pixel-perfect accuracy. Features a ultra-lightweight honeycomb design at just 68 grams, 60-hour rechargeable battery life, and seamless dual-mode connectivity via Bluetooth and 2.4GHz wireless. Ideal for FPS gamers and professionals alike.'],
            ['name' => 'Cosmos 4K Monitor', 'description' => 'Stunning 27-inch 4K IPS display delivering vibrant colors with 99% sRGB coverage and HDR10 support. Boasts a 144Hz refresh rate and 1ms response time for fluid visuals in gaming and creative work. Includes an adjustable ergonomic stand, VESA mount compatibility, and built-in blue light filter for extended viewing comfort.'],
            ['name' => 'Orbit Gaming Headset', 'description' => 'Over-ear gaming headset with advanced active noise cancellation technology that blocks out ambient distractions. Delivers immersive 7.1 virtual surround sound through 50mm neodymium drivers. Features a detachable noise-cancelling boom microphone, memory foam ear cushions, and a lightweight frame for marathon gaming sessions.'],
            ['name' => 'Pulsar Gaming Laptop', 'description' => 'High-performance gaming laptop powered by an NVIDIA RTX 4070 GPU and Intel Core i7 processor. Comes with 16GB DDR5 RAM, a 1TB NVMe SSD for lightning-fast load times, and a 15.6-inch 165Hz IPS display with adaptive sync technology. Advanced cooling system with dual fans and vapor chamber keeps temperatures in check during intense gameplay.'],
            ['name' => 'Quasar Webcam Pro', 'description' => '4K ultra-HD webcam with advanced auto-focus and automatic light correction for professional-quality video in any environment. Features a built-in adjustable ring light with three brightness levels, dual noise-reducing microphones, and wide-angle lens. Compatible with all major streaming and video conferencing platforms right out of the box.'],
            ['name' => 'Astro USB-C Hub', 'description' => 'Versatile 12-in-1 USB-C hub designed for modern workstations and on-the-go professionals. Includes HDMI 2.1 output supporting 4K at 60Hz, Gigabit Ethernet, SD and microSD card readers, three USB-A 3.0 ports, and 100W power delivery pass-through charging. Compact aluminum body dissipates heat efficiently for stable long-term performance.'],
            ['name' => 'Galaxy SSD 2TB', 'description' => 'Ultra-fast 2TB NVMe solid state drive delivering sequential read speeds of up to 7000MB/s and write speeds of 6500MB/s. Built on PCIe Gen 4 technology with DRAM cache for sustained performance under heavy workloads. Features advanced thermal throttling protection and a slim M.2 2280 form factor compatible with desktops, laptops, and PS5.'],
            ['name' => 'Nova Mechanical Numpad', 'description' => 'Compact wireless mechanical numpad crafted with a premium aluminum frame and hot-swappable switch sockets for easy customization. Connects via Bluetooth 5.0 or USB-C wired mode. Features per-key RGB backlighting, a rechargeable battery lasting up to two weeks, and a slim profile that pairs perfectly with 60% and 65% keyboards.'],
            ['name' => 'Supernova RGB Mousepad XL', 'description' => 'Extra-large RGB gaming mousepad measuring 900x400mm with a micro-textured cloth surface optimized for both speed and control. Features 14 dynamic lighting modes with edge-to-edge LED illumination, powered via USB. The 4mm non-slip rubber base keeps the pad firmly in place during intense gaming sessions, and the surface is waterproof and easy to clean.'],
            ['name' => 'Eclipse Laptop Stand', 'description' => 'Adjustable aluminum laptop stand with a premium anodized finish and open ventilation design that promotes airflow to keep your laptop cool. Supports laptops from 10 to 17 inches with six height adjustment levels. Features silicone padding to protect your device from scratches, cable management cutouts, and a foldable design for easy portability.'],
            ['name' => 'Photon Wireless Earbuds', 'description' => 'True wireless earbuds equipped with hybrid active noise cancellation and transparency mode for situational awareness. Deliver rich, balanced audio through custom 11mm dynamic drivers with Bluetooth 5.3 multipoint connectivity. The compact charging case provides 32 hours of total battery life, and the earbuds feature IPX5 water resistance for workouts and rainy commutes.'],
            ['name' => 'Meteor Portable Charger', 'description' => 'High-capacity 20000mAh portable power bank with 65W USB-C Power Delivery for fast charging laptops, tablets, and smartphones simultaneously. Features an LED display showing exact battery percentage, dual USB-C ports, and one USB-A port. The compact and lightweight aluminum body fits easily in a backpack, making it the perfect travel companion for professionals and digital nomads.'],
            ['name' => 'Horizon Smart Desk Lamp', 'description' => 'Modern LED desk lamp with an integrated 15W Qi wireless charging pad built into the base. Offers adjustable color temperature ranging from warm 2700K to cool daylight 6500K with stepless brightness control via touch panel. The flexible gooseneck arm provides precise light positioning, and the lamp remembers your last setting for convenience.'],
            ['name' => 'Zenith Ergonomic Chair', 'description' => 'Full-mesh ergonomic office chair engineered for all-day comfort with adjustable lumbar support that conforms to your spine. Features a breathable mesh backrest, padded headrest with tilt adjustment, and 4D armrests that move up, down, forward, backward, and pivot. The heavy-duty base supports up to 300 lbs with smooth-rolling casters suitable for hardwood and carpet floors.'],
            ['name' => 'Vortex Capture Card', 'description' => '4K60 HDR capture card with ultra-low latency passthrough that lets you game on your monitor while recording or streaming at full quality. Compatible with OBS, Streamlabs, XSplit, and all major broadcasting software. Supports HDMI 2.0 input and output with HDR10 passthrough, and connects to your PC via USB 3.0 for reliable high-bandwidth data transfer without dropped frames.'],
            ['name' => 'Comet Streaming Microphone', 'description' => 'Professional USB condenser microphone with a cardioid polar pattern optimized for voice capture in streaming, podcasting, and video calls. Features a built-in pop filter and shock mount to minimize plosives and vibrations. Includes a zero-latency 3.5mm headphone jack for real-time monitoring, one-touch mute button with LED indicator, and adjustable gain control directly on the microphone body.'],
            ['name' => 'Lunar Wireless Controller', 'description' => 'Bluetooth gaming controller featuring Hall Effect analog joysticks that eliminate stick drift for a lifetime of precise control. Includes programmable back paddles, dual rumble motors for immersive haptic feedback, and a 40-hour rechargeable battery. Compatible with PC, Nintendo Switch, Android, and iOS devices with seamless switching between up to three paired devices.'],
            ['name' => 'Starlight LED Strip Kit', 'description' => '5-meter addressable RGB LED strip kit with individual pixel control for stunning lighting effects. Includes a Wi-Fi controller with dedicated app for custom scenes, music sync mode that reacts to audio in real time, and support for voice control via smart home assistants. Easy peel-and-stick 3M adhesive backing with cuttable segments every 5cm for a perfect fit in any setup.'],
            ['name' => 'Titan Curved Monitor', 'description' => 'Ultrawide 32-inch curved VA display with an aggressive 1500R curvature for a truly immersive viewing experience. Delivers a blazing 240Hz refresh rate and 1ms MPRT response time for competitive gaming. Features AMD FreeSync Premium, 95% DCI-P3 color gamut, built-in 5W stereo speakers, and a fully adjustable stand with height, tilt, and swivel adjustments.'],
        ];

        $product = fake()->unique()->randomElement($products);

        return [
            'name' => $product['name'],
            'description' => $product['description'],
            'price' => fake()->numberBetween(29, 1499),
            'stock' => fake()->numberBetween(10, 120),
            'image' => fake()->slug(3).'.png',
        ];
    }
}
