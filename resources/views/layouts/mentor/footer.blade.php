{{-- resources/views/layouts/mentor/footer.blade.php --}}
<footer
  class="bg-[#0d1735] px-4 sm:px-8 md:px-12 py-7 flex flex-wrap justify-between items-center gap-3.5 mt-14 pb-[calc(74px+16px)] md:pb-7">
  <p class="text-[13px] text-[#4a6a9f] m-0">© 2026 PKKMB-KT UNILAM. Semua hak dilindungi.</p>
  <div class="flex gap-5">
    <a
      href="{{ route('landing.kebijakan-privasi') }}"
      class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Kebijakan Privasi</a>
    <a
      href="{{ route('landing.syarat-ketentuan') }}"
      class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Syarat &amp; Ketentuan</a>
    <a
      href="{{ route('landing.bantuan') }}"
      class="text-[13px] text-[#4a6a9f] no-underline transition-colors hover:text-[#aeb6e0]">Bantuan</a>
  </div>
</footer>
