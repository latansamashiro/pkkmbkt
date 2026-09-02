{{--
    resources/views/components/informasi-carousel.blade.php
    Props:
    - items    : Collection<Information> (maks 5, urut terbaru dulu)
    - infoRoute: string  -> route menu "Info" (role.student.info / role.mentor.info)
--}}
@props(['items', 'infoRoute'])

@if ($items->count() > 0)
<section class="section info-terbaru">
  <div class="section-head">
    <h3 class="section-title">Informasi Terbaru</h3>
    <a href="{{ $infoRoute }}" class="section-link">
      Lihat Semua
      <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 6l6 6-6 6" />
      </svg>
    </a>
  </div>

  <div class="info-carousel">
    <div class="info-carousel-track" id="infoCarouselTrack">
      @foreach ($items as $item)
        <a href="{{ $infoRoute }}" class="info-card-mini {{ $item->important_flag ? 'is-urgent' : '' }}">
          <span class="info-card-mini-icon">📢</span>
          <span class="info-card-mini-body">
            <span class="info-card-mini-tag">{{ strtoupper($item->category ?? 'UMUM') }}</span>
            <span class="info-card-mini-title">{{ $item->title }}</span>
            <span class="info-card-mini-time">{{ $item->created_at->diffForHumans() }}</span>
          </span>
        </a>
      @endforeach
    </div>

    @if ($items->count() > 1)
      <div class="info-carousel-dots" id="infoCarouselDots">
        @foreach ($items as $idx => $item)
          <span class="info-dot {{ $idx === 0 ? 'active' : '' }}" data-index="{{ $idx }}"></span>
        @endforeach
      </div>
    @endif
  </div>
</section>

<style type="text/tailwindcss">
  .info-carousel { @apply relative; }
  .info-carousel-track {
    @apply flex gap-3 overflow-x-auto pb-1;
    scroll-snap-type: x mandatory;
    scrollbar-width: none;
  }
  .info-carousel-track::-webkit-scrollbar { display: none; }
  .info-card-mini {
    @apply flex-shrink-0 flex items-center gap-3 bg-surface border border-border rounded-[18px] transition-all;
    width: min(280px, 82%);
    padding: 14px 16px;
    scroll-snap-align: start;
  }
  .info-card-mini:hover { @apply shadow-[0_2px_14px_rgba(21,33,89,0.07),0_1px_2px_rgba(21,33,89,0.05)] border-transparent; }
  .info-card-mini.is-urgent { @apply border-[#e0a728]; }
  .info-card-mini-icon {
    @apply flex-shrink-0 w-11 h-11 rounded-[13px] flex items-center justify-center text-xl bg-teal-tint;
  }
  .info-card-mini.is-urgent .info-card-mini-icon { @apply bg-[#fbf1dc]; }
  .info-card-mini-body { @apply flex-1 min-w-0 flex flex-col gap-0.5; }
  .info-card-mini-tag { @apply text-[10px] font-extrabold tracking-[0.04em] text-teal-600; }
  .info-card-mini.is-urgent .info-card-mini-tag { @apply text-[#e0a728]; }
  .info-card-mini-title {
    @apply text-[13.5px] font-bold text-ink-900 leading-[1.3] overflow-hidden;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
  }
  .info-card-mini-time { @apply text-[11px] text-ink-400; }

  .info-carousel-dots { @apply flex items-center justify-center gap-1.5 mt-3; }
  .info-dot { @apply w-1.5 h-1.5 rounded-full bg-border transition-all; }
  .info-dot.active { @apply w-4 bg-teal-600; }
</style>

<script>
  $(function () {
    const $track = $('#infoCarouselTrack');
    const $dots = $('#infoCarouselDots').find('.info-dot');
    if (!$track.length || !$dots.length) return;

    // Klik dot -> geser track ke card itu
    $dots.on('click', function () {
      const i = $(this).data('index');
      const $card = $track.children().eq(i);
      if ($card.length) {
        $track.animate({ scrollLeft: $card.position().left + $track.scrollLeft() - $track.position().left }, 250);
      }
    });

    // Scroll (manual atau auto) -> update dot aktif sesuai card yang paling kelihatan
    let ticking = false;
    $track.on('scroll', function () {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(function () {
        const trackLeft = $track.offset().left;
        let closest = 0, closestDist = Infinity;
        $track.children().each(function (i) {
          const dist = Math.abs($(this).offset().left - trackLeft);
          if (dist < closestDist) { closestDist = dist; closest = i; }
        });
        $dots.removeClass('active').eq(closest).addClass('active');
        ticking = false;
      });
    });

    // Auto-geser tiap 5 detik, balik ke awal setelah card terakhir
    if ($track.children().length > 1) {
      setInterval(function () {
        const $cards = $track.children();
        const maxScroll = $track[0].scrollWidth - $track[0].clientWidth;
        const nearEnd = $track.scrollLeft() >= maxScroll - 10;
        if (nearEnd) {
          $track.animate({ scrollLeft: 0 }, 300);
        } else {
          const next = $dots.filter('.active').data('index') + 1;
          const $card = $cards.eq(next);
          if ($card.length) {
            $track.animate({ scrollLeft: $card.position().left + $track.scrollLeft() - $track.position().left }, 300);
          }
        }
      }, 5000);
    }
  });
</script>
@endif
