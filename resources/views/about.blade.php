<x-app-layout>
    <section
        id="mainSection"
        class="bg-[url('/public/images/schapen.jpg')] bg-no-repeat bg-cover bg-left overflow-hidden"
    >
        <x-infobox heading="Over ons">
            Wij werken in samenwerking met de natuurmonumenten om hun doelen te steunen.
            <a href="https://www.natuurmonumenten.nl/" target="_blank" class="mt-2">
                <x-button size="small" :arrow="false" variant="secondary">
                    Natuurmonumenten
                </x-button>
            </a>
        </x-infobox>
        <div class="mt-24">
            <x-infobox heading="Contact">
                Wij zijn te bereiken via onderstaande platformen:
                <div class="social_links">
                    <a href="mailto:info@natuurmonumenten.nl" target="_blank"><i class="fa-solid fa-envelope"></i></a>
                    <a href="https://www.facebook.com/natuurmonumenten" target="_blank"><i
                            class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/natuurmonumenten" target="_blank"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.youtube.com/natuurmonumenten" target="_blank"><i
                            class="fa-brands fa-youtube"></i></a>
                </div>
            </x-infobox>
        </div>
    </section>
</x-app-layout>
