{{-- resources/views/calculadora.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Calculadora de placas solares | Precio orientativo en 1 minuto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Calcula el precio orientativo de tu instalación de placas solares en 1 minuto." />

  {{-- Tailwind --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/calculadora.css') }}">

  {{-- Leaflet --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  {{-- Turf (m²) --}}
  <script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script>

  <style>
    /* ===== Layout mapa ===== */
    #sc-step-map{ position:relative; min-height:100vh; width:100%; }
    #scMap{ position:absolute; inset:0; z-index:10; }
    .sc-overlay{ position:absolute; left:0; right:0; top:0; z-index:50; }
    .sc-hints{ position:absolute; left:0; right:0; bottom:0; z-index:50; }

    #suggest{
      position:absolute !important;
      left:0; right:0;
      top:calc(100% + 8px);
      z-index:99999 !important;
    }

    /* Ocultamos toolbar de geoman */
    .leaflet-pm-toolbar{ display:none !important; }

    /* ===== Selección vivienda (Paso 1) ===== */
    .sc-housing-card.is-selected{
      background:#0f172a !important;
      color:#fff !important;
      border-color: rgba(15,23,42,.45) !important;
      box-shadow: 0 18px 50px -30px rgba(15,23,42,.35) !important;
      transform: translateY(-2px);
    }
    .sc-housing-card.is-selected h3{ color:#fff !important; }
    .sc-housing-card.is-selected [data-housing-sub]{ color: rgba(255,255,255,.78) !important; }

    /* ===== Modo “solo calculadora” (opcional) ===== */
    body.sc-calc-full #presentacion,
    body.sc-calc-full #seo{ display:none !important; }
    body.sc-calc-full #calculadora{ display:block !important; }

    /* ===== PASO 3 (Bill) — look pro ===== */
    .sc-bill-card{
      position: relative;
      border-radius: 24px;
      border: 1px solid rgba(15,23,42,.10);
      background: rgba(255,255,255,.92);
      box-shadow: 0 10px 30px -25px rgba(15,23,42,.18);
      min-height: 168px;
      padding: 28px;
      transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease, background .18s ease;
    }
    .sc-bill-card:hover{
      transform: translateY(-3px);
      box-shadow: 0 22px 60px -45px rgba(15,23,42,.35);
      border-color: rgba(15,23,42,.18);
    }
    .sc-bill-card .bill-icon{
      width: 52px;
      height: 52px;
      border-radius: 16px;
      background: rgba(15,23,42,.03);
      border: 1px solid rgba(15,23,42,.10);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: #0f172a;
    }
    .sc-bill-card svg{ color: #0f172a; }

    .sc-bill-card.is-selected{
      background: #ffffff !important;
      border-color: rgba(245,158,11,.65) !important; /* amber */
      box-shadow: 0 26px 80px -55px rgba(245,158,11,.55), 0 10px 25px -20px rgba(15,23,42,.25);
      transform: translateY(-3px);
    }
    .sc-bill-card.is-selected::before{
      content:"";
      position:absolute;
      inset:0;
      border-radius: 24px;
      pointer-events:none;
      background: linear-gradient(180deg, rgba(245,158,11,.18), transparent 42%);
    }
    .sc-bill-card.is-selected .bill-icon{
      background: rgba(245,158,11,.12);
      border-color: rgba(245,158,11,.35);
    }
    .sc-bill-card.is-selected [data-bill-sub]{
      color: rgba(15,23,42,.75) !important;
    }

    /* “No lo sé” integrado (sin tarjeta) */
    .sc-bill-nose{
      display: inline-flex;
      align-items: center;
      gap: .55rem;
      padding: 10px 14px;
      border-radius: 999px;
      border: 1px dashed rgba(15,23,42,.18);
      background: rgba(255,255,255,.7);
      color: rgba(15,23,42,.72);
      transition: background .18s ease, border-color .18s ease, color .18s ease, transform .18s ease;
    }
    .sc-bill-nose:hover{
      background:#fff;
      border-color: rgba(15,23,42,.28);
      color: rgba(15,23,42,.92);
      transform: translateY(-1px);
    }
    .sc-bill-nose.is-selected{
      border-style: solid;
      border-color: rgba(245,158,11,.65);
      box-shadow: 0 18px 60px -45px rgba(245,158,11,.45);
      background: #fff;
      color: rgba(15,23,42,.92);
    }
  </style>
</head>

<body class="min-h-screen text-slate-900">
  {{-- (opcional) para que Tailwind no purgue clases raras si algún día lo compilas --}}
  <div class="hidden bg-slate-900 text-white border-slate-900 ring-2 ring-slate-900 shadow-xl -translate-y-1 text-white/80"></div>

  <a class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:rounded-xl focus:bg-white focus:px-4 focus:py-2 focus:text-slate-900 focus:shadow-lg"
     href="#presentacion">Saltar al contenido</a>

  {{-- ======================================================
       HERO
  ====================================================== --}}
  <section id="presentacion" class="relative overflow-hidden" aria-labelledby="hero-title">
    <div class="pointer-events-none absolute inset-0 -z-10">
      <div class="absolute inset-0 bg-gradient-to-b from-white via-slate-50 to-white"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_15%,rgba(15,23,42,.05),transparent_40%),radial-gradient(circle_at_85%_30%,rgba(15,23,42,.035),transparent_45%)]"></div>
    </div>

    <div class="mx-auto grid min-h-[calc(100vh-64px)] max-w-6xl grid-cols-1 items-center gap-10 px-4 py-12 lg:grid-cols-12 lg:py-16">
      <div class="lg:col-span-7">
        <div class="sc-anim inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-700 shadow-sm">
          ⚡ Estimación orientativa · 1 minuto · Sin compromiso
        </div>

        <h1 id="hero-title" class="sc-anim mt-5 text-4xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-5xl">
          Calcula el precio de tus placas solares
          <span class="block text-transparent bg-clip-text bg-gradient-to-r from-amber-500 via-yellow-500 to-emerald-500">
            en 1 minuto
          </span>
        </h1>

        <p class="sc-anim mt-5 max-w-xl text-base text-slate-700 sm:text-lg">
          Responde a unas preguntas rápidas y obtén una estimación orientativa de
          <strong class="text-slate-900">potencia (kWp)</strong>, <strong class="text-slate-900">nº de paneles</strong>,
          <strong class="text-slate-900">presupuesto</strong> y <strong class="text-slate-900">ahorro anual</strong>.
        </p>

        <div class="sc-anim mt-6 flex flex-wrap gap-2" aria-label="Puntos clave">
          <span class="sc-pill inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-700 shadow-sm">🏠 Vivienda</span>
          <span class="sc-pill inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-700 shadow-sm">🧭 Orientación</span>
          <span class="sc-pill inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-700 shadow-sm">⚡ Consumo</span>
          <span class="sc-pill inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-700 shadow-sm">📍 Provincia</span>
        </div>

        <div class="sc-anim mt-8 flex flex-wrap items-center gap-3">
          <button id="enterCalculator" type="button"
            class="sc-btn-shine sc-focus inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-extrabold text-white">
            Entrar en la calculadora
          </button>

          <a href="#seo"
             class="sc-btn-shine sc-focus inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-slate-50">
            Ver información y FAQ
          </a>

          <div class="w-full text-xs text-slate-600">
            *Cifra orientativa. El precio final se ajusta con un estudio técnico.
          </div>
        </div>
      </div>

      <aside class="lg:col-span-5" aria-label="Resumen de la estimación">
        <div class="sc-card sc-tilt sc-anim rounded-3xl border border-slate-200 p-6 shadow-[0_22px_70px_-50px_rgba(15,23,42,.25)]">
          <div class="flex items-center justify-between gap-3">
            <div>
              <div class="text-sm font-extrabold text-slate-900">Tu estimación</div>
              <div class="mt-1 text-xs text-slate-600">Resultado orientativo al instante</div>
            </div>

            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
              <span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
              Al instante
            </span>
          </div>
        </div>
      </aside>
    </div>
  </section>

  {{-- SEO --}}
  <section id="seo" class="py-14 text-slate-900" aria-label="Preguntas frecuentes y contenido informativo">
    {{-- ... pega aquí tu bloque SEO completo ... --}}
  </section>

  {{-- ======================================================
       CALCULADORA (OCULTA AL CARGAR)
  ====================================================== --}}
  <section id="calculadora" class="py-0 hidden">

    {{-- barra superior para salir --}}
    <div class="sticky top-0 z-[60] border-b border-slate-200 bg-white/90 backdrop-blur">
      <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
        <div class="text-sm font-extrabold text-slate-900">Calculadora solar</div>
        <button id="exitCalculator" type="button"
          class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-900 hover:bg-slate-50">
          ✕ Cerrar
        </button>
      </div>
    </div>

    {{-- PASO 1: TIPO VIVIENDA --}}
    <section id="sc-step-housing" class="py-20 bg-slate-50">
      <div class="mx-auto max-w-4xl px-4 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900">¿Qué tipo de vivienda es?</h2>
        <p class="mt-3 text-slate-600">Así adaptamos el cálculo a tu situación real.</p>

        <div class="mt-10 grid gap-6 sm:grid-cols-2">
          <button type="button" data-housing="single"
            class="sc-housing-card rounded-3xl border border-slate-200 bg-white p-8 text-left shadow-sm transition hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-900/20">
            <div class="text-4xl">🏠</div>
            <h3 class="mt-4 text-lg font-extrabold">Vivienda unifamiliar</h3>
            <p class="mt-2 text-sm text-slate-600" data-housing-sub>Casa independiente con tejado propio.</p>
          </button>

          <button type="button" data-housing="community"
            class="sc-housing-card rounded-3xl border border-slate-200 bg-white p-8 text-left shadow-sm transition hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-900/20">
            <div class="text-4xl">🏢</div>
            <h3 class="mt-4 text-lg font-extrabold">Comunidad de vecinos</h3>
            <p class="mt-2 text-sm text-slate-600" data-housing-sub>Piso o ático en edificio compartido.</p>
          </button>
        </div>

        <input type="hidden" id="sc_housing_type">

        <div class="mt-10 flex flex-col items-center gap-3">
          <button id="housingContinueBtn" type="button" disabled
            class="inline-flex items-center justify-center rounded-2xl bg-yellow-400 px-8 py-3 text-sm font-extrabold text-slate-900 shadow-sm
                   disabled:opacity-50 disabled:cursor-not-allowed hover:bg-yellow-300">
            Continuar →
          </button>

          <p id="housingHelp" class="text-xs text-slate-500">
            Selecciona una opción para continuar.
          </p>
        </div>
      </div>
    </section>

    {{-- PASO 2: MAPA (OCULTO) --}}
    <div id="sc-step-map" class="hidden">
      <div id="scMap"></div>

      <div class="sc-overlay">
        <div class="mx-auto max-w-6xl px-4 pt-4">
          <div class="sc-card rounded-3xl border border-slate-200 bg-white p-5 shadow-lg overflow-visible">
            <div class="flex flex-wrap items-center justify-between gap-4">
              <div>
                <div class="text-sm font-extrabold text-slate-900">Paso 2 · Ubicación y superficie</div>
                <p class="mt-1 text-sm text-slate-600">Busca tu vivienda y dibuja el área donde deseas instalar los paneles solares.</p>
              </div>

              <div class="flex gap-2">
                <button id="btnLocate" type="button"
                  class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-bold text-white hover:bg-slate-800">
                  📍 Mi ubicación
                </button>

                <button id="btnNext" type="button" disabled
                  class="rounded-2xl bg-yellow-400 px-4 py-2 text-sm font-extrabold text-slate-900 disabled:opacity-50">
                  Continuar →
                </button>
              </div>
            </div>

            <div class="mt-4 relative">
              <input id="addr" type="text" autocomplete="off"
                placeholder="Ej: Calle Mayor 10, Madrid"
                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm">
              <div id="suggest"
                class="hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
              </div>
            </div>

            <div class="mt-4 flex flex-wrap items-center gap-3 text-sm">
              <div class="inline-flex items-center gap-1 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs font-semibold text-slate-900">
                Superficie:
                <span id="mapAreaValue" class="font-black">0</span> m²
              </div>

              <button id="mapDrawBtn" type="button"
                class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-xs font-extrabold bg-slate-900 text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900/30">
                ✏️ Dibujar tejado
              </button>

              <button type="button"
                class="mapClearBtn inline-flex items-center gap-2 rounded-xl px-4 py-2 text-xs font-extrabold border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300 disabled:opacity-50 disabled:cursor-not-allowed">
                🗑️ Borrar
              </button>

              <span class="hidden sm:inline text-xs text-slate-500">
                Haz clic en las esquinas del tejado · Doble clic para cerrar
              </span>
            </div>

            <input type="hidden" id="sc_lat">
            <input type="hidden" id="sc_lng">
            <input type="hidden" id="sc_area_m2">
            <input type="hidden" id="sc_geojson">
          </div>
        </div>
      </div>

      <div class="sc-hints">
        <div class="mx-auto max-w-6xl px-4 pb-4">
          <div id="mapHint" class="hidden rounded-3xl border border-slate-200 bg-white p-4 text-sm shadow-lg"></div>
        </div>
      </div>
    </div>

    {{-- PASO 3: GASTO MENSUAL (REHECHO, MÁS LIMPIO Y PRO) --}}
    <section id="sc-step-bill" class="hidden py-20 bg-slate-50">
  <div class="mx-auto max-w-5xl px-4 text-center">

    <h2 class="text-3xl font-extrabold text-slate-900">
      ¿Cuánto pagas de luz al mes?
    </h2>
    <p class="mt-3 text-slate-600">
      Nos sirve para estimar consumo, tamaño de instalación y ahorro aproximado.
    </p>

    <!-- GRID -->
    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

      <!-- CARD -->
      <button type="button" data-bill="0-50"
        class="sc-bill-card2 group w-full rounded-3xl border border-slate-200 bg-white px-8 py-7 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-900/10">
        <div class="mx-auto mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50">
          <svg class="h-6 w-6 text-slate-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2m0 14v2M5 12H3m18 0h-2M6.34 6.34 5 5m14 14-1.34-1.34M6.34 17.66 5 19m14-14-1.34 1.34"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12a4 4 0 108 0 4 4 0 10-8 0z"/>
          </svg>
        </div>
        <div class="text-lg font-extrabold text-slate-900">Menos de 50 €</div>
        <div class="mt-1 text-sm text-slate-600">Consumo bajo</div>
      </button>

      <button type="button" data-bill="50-100"
        class="sc-bill-card2 group w-full rounded-3xl border border-slate-200 bg-white px-8 py-7 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-900/10">
        <div class="mx-auto mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50">
          <svg class="h-6 w-6 text-slate-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 2L3 14h7l-1 8 12-14h-7l-1-6z"/>
          </svg>
        </div>
        <div class="text-lg font-extrabold text-slate-900">50 – 100 €</div>
        <div class="mt-1 text-sm text-slate-600">Consumo medio</div>
      </button>

      <!-- ✅ ICONO CAMBIADO AQUÍ (100–150 €) -->
      <button type="button" data-bill="100-150"
        class="sc-bill-card2 group w-full rounded-3xl border border-slate-200 bg-white px-8 py-7 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-900/10">
        <div class="mx-auto mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50">
          <svg class="h-6 w-6 text-slate-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M11 3L4 14h6l-1 7 9-11h-6l1-7z"/>
          </svg>
        </div>
        <div class="text-lg font-extrabold text-slate-900">100 – 150 €</div>
        <div class="mt-1 text-sm text-slate-600">Consumo alto</div>
      </button>

      <button type="button" data-bill="150-200"
        class="sc-bill-card2 group w-full rounded-3xl border border-slate-200 bg-white px-8 py-7 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-900/10">
        <div class="mx-auto mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50">
          <svg class="h-6 w-6 text-slate-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10l9-7 9 7v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 22V12h6v10"/>
          </svg>
        </div>
        <div class="text-lg font-extrabold text-slate-900">150 – 200 €</div>
        <div class="mt-1 text-sm text-slate-600">Consumo elevado</div>
      </button>

      <button type="button" data-bill="200+"
        class="sc-bill-card2 group w-full rounded-3xl border border-slate-200 bg-white px-8 py-7 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-900/10">
        <div class="mx-auto mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50">
          <svg class="h-6 w-6 text-slate-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2s5 4 5 9a5 5 0 11-10 0c0-5 5-9 5-9z"/>
          </svg>
        </div>
        <div class="text-lg font-extrabold text-slate-900">Más de 200 €</div>
        <div class="mt-1 text-sm text-slate-600">Consumo muy alto</div>
      </button>

      <!-- NO LO SÉ -->
      <button type="button" data-bill="no-se"
        class="sc-bill-card2 group w-full rounded-3xl border border-slate-200 bg-white px-8 py-7 text-center shadow-sm transition hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-900/10">
        <div class="mx-auto mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50">
          <svg class="h-6 w-6 text-slate-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 9a3 3 0 115.8 1c-.9.9-1.8 1.4-1.8 3"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 17h.01"/>
            <circle cx="12" cy="12" r="10"/>
          </svg>
        </div>
        <div class="text-lg font-extrabold text-slate-900">No lo sé</div>
        <div class="mt-1 text-sm text-slate-600">Prefiero una estimación</div>
      </button>
    </div>

    <input type="hidden" id="sc_bill_monthly">

    <!-- CONTINUAR -->
    <div class="mt-10 flex flex-col items-center gap-3">
      <button id="billContinueBtn" type="button" disabled
        class="inline-flex items-center justify-center rounded-2xl bg-yellow-400 px-8 py-3 text-sm font-extrabold text-slate-900 shadow-sm
               disabled:opacity-50 disabled:cursor-not-allowed hover:bg-yellow-300">
        Continuar →
      </button>

      <p id="billHelp" class="text-xs text-slate-500">
        Selecciona una opción para continuar.
      </p>
    </div>
  </div>
    </section>


    {{-- PASO FINAL: DATOS DEL CLIENTE --}}
<section id="sc-step-lead" class="hidden py-20 bg-slate-50">
  <div class="mx-auto max-w-4xl px-4">

    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
      <div class="text-center max-w-xl mx-auto">
        <h2 class="text-3xl font-extrabold text-slate-900">
          Tu estimación está casi lista
        </h2>

        <p class="mt-4 text-base text-slate-600 leading-relaxed">
          Déjanos tus datos y te enviamos una estimación orientativa
          basada en la información que acabas de introducir.
        </p>
    </div>

      <form id="leadForm" class="mt-8 grid gap-4 sm:grid-cols-2" method="POST" action="#">
        {{-- @csrf --}}

        <div class="sm:col-span-2 text-left">
          <label for="lead_name" class="block text-sm font-bold text-slate-900">Nombre</label>
          <input id="lead_name" name="name" type="text" required
            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-slate-900/10"
            placeholder="Tu nombre">
        </div>

        <div class="text-left">
          <label for="lead_phone" class="block text-sm font-bold text-slate-900">Teléfono</label>
          <input id="lead_phone" name="phone" type="tel" inputmode="tel" required
            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-slate-900/10"
            placeholder="Ej: 600 000 000">
        </div>

        <div class="text-left">
          <label for="lead_email" class="block text-sm font-bold text-slate-900">Correo</label>
          <input id="lead_email" name="email" type="email" required
            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-slate-900/10"
            placeholder="tu@email.com">
        </div>

        {{-- Hidden con datos recogidos --}}
        <input type="hidden" name="housing_type" id="lead_housing_type">
        <input type="hidden" name="lat" id="lead_lat">
        <input type="hidden" name="lng" id="lead_lng">
        <input type="hidden" name="area_m2" id="lead_area_m2">
        <input type="hidden" name="geojson" id="lead_geojson">
        <input type="hidden" name="bill_monthly" id="lead_bill_monthly">

        <div class="sm:col-span-2 mt-2">
          <button id="leadSubmitBtn" type="submit"
            class="w-full rounded-2xl bg-slate-900 px-6 py-4 text-sm font-extrabold text-white shadow-sm hover:bg-slate-800">
            Ver mi estimación →
          </button>

          <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-xs text-slate-600">
            <span class="font-bold text-slate-900">Privacidad:</span>
            usaremos tus datos solo para enviarte la estimación y contactarte si lo solicitas. Sin spam.
          </div>
        </div>

      </form>
    </div>

  </div>
</section>

{{-- PANTALLA: CALCULANDO --}}
<section id="sc-step-loading" class="hidden py-20 bg-slate-50">
  <div class="mx-auto max-w-3xl px-4">
    <div class="rounded-3xl border border-slate-200 bg-white p-10 shadow-sm text-center">
      <div class="mx-auto mb-6 h-12 w-12 rounded-2xl border border-slate-200 bg-slate-50 grid place-items-center">
        <span class="sc-spin inline-block h-6 w-6 rounded-full border-2 border-slate-300 border-t-slate-900"></span>
      </div>

      <h2 class="text-2xl font-extrabold text-slate-900">Calculando tu estimación…</h2>
      <p class="mt-3 text-slate-600">
        Estamos analizando superficie, consumo y una producción media estimada.
      </p>

      <div class="mt-6 mx-auto max-w-md">
        <div class="h-2 w-full rounded-full bg-slate-100 overflow-hidden">
          <div id="scProgress" class="h-full w-0 bg-slate-900 rounded-full transition-all duration-700"></div>
        </div>
        <div class="mt-3 text-xs text-slate-500" id="scLoadingText">Preparando datos…</div>
      </div>
    </div>
  </div>
</section>

{{-- PANTALLA: RESULTADO (REHECHA) --}}
<section id="sc-step-result" class="hidden py-16 bg-slate-50">
  <div class="mx-auto max-w-6xl px-4">

    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
      <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">

        <!-- IZQUIERDA: TITULO + COPY + CTA -->
        <div class="lg:w-[44%]">
          <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-bold text-slate-700">
            Resultado orientativo
          </div>

          <h2 class="mt-4 text-3xl font-extrabold leading-tight text-slate-900 sm:text-4xl">
            Tu estimación ya está lista
          </h2>

          <p class="mt-4 text-slate-600 leading-relaxed">
            Estos valores son orientativos y se ajustan con un estudio técnico. Si lo deseas, validamos
            contigo el tejado y afinamos el presupuesto.
          </p>

          <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <div class="text-xs font-bold text-slate-600">Resumen</div>
            <div class="mt-2 text-sm text-slate-700">
              Superficie: <span class="font-extrabold text-slate-900" id="resArea">—</span> m² ·
              Gasto: <span class="font-extrabold text-slate-900" id="resBill">—</span> €/mes
            </div>
          </div>

          <div class="mt-7 flex flex-col gap-3 sm:flex-row">
            <a href="#presentacion"
               class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-extrabold text-white hover:bg-slate-800 sm:w-auto">
              Volver al inicio
            </a>

            <button type="button" id="resRecalc"
              class="inline-flex w-full items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-900 hover:bg-slate-50 sm:w-auto">
              Recalcular
            </button>
          </div>

          <p class="mt-4 text-xs text-slate-500">
            *Estimación orientativa. El precio final depende del estudio técnico, materiales y accesibilidad del tejado.
          </p>
        </div>

        <!-- DERECHA: METRICAS -->
        <div class="lg:w-[56%]">
          <div class="grid gap-4 sm:grid-cols-2">

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
              <div class="text-xs font-bold text-slate-600">Potencia estimada</div>
              <div class="mt-2 text-4xl font-extrabold text-slate-900">
                <span id="resKwp">—</span><span class="text-2xl font-extrabold"> kWp</span>
              </div>
              <div class="mt-2 text-sm text-slate-600">Recomendación orientativa</div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
              <div class="text-xs font-bold text-slate-600">Nº de paneles</div>
              <div class="mt-2 text-4xl font-extrabold text-slate-900">
                <span id="resPanels">—</span>
              </div>
              <div class="mt-2 text-sm text-slate-600">~450 W por panel</div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:col-span-2">
              <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                  <div class="text-xs font-bold text-slate-600">Presupuesto orientativo</div>
                  <div class="mt-2 text-4xl font-extrabold text-slate-900">
                    <span id="resPriceMin">—</span> – <span id="resPriceMax">—</span> €
                  </div>
                </div>

                <div class="text-sm text-slate-600">
                  Instalación estándar · Sin baterías
                </div>
              </div>

              <div class="mt-4 h-px bg-slate-100"></div>

              <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div class="text-sm text-slate-600">Ahorro anual aprox.</div>
                <div class="text-2xl font-extrabold text-slate-900">
                  <span id="resSave">—</span> €/año
                </div>
              </div>
            </div>

          </div>

          <div class="mt-5 rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
            Consejo: si tu consumo es alto, podemos optimizar el autoconsumo ajustando potencia y orientación.
          </div>
        </div>

      </div>
    </div>

  </div>
</section>


<style>
  .sc-spin{ animation: scspin 1s linear infinite; }
  @keyframes scspin { to { transform: rotate(360deg); } }
</style>


<style>
/* ===== PASO 3 SELECCIÓN (NUEVO) ===== */
.sc-bill-card2{ position:relative; }
.sc-bill-card2.is-selected{
  border-color: rgba(245,158,11,.70) !important;
  box-shadow: 0 22px 70px -55px rgba(245,158,11,.65), 0 16px 40px -45px rgba(15,23,42,.35) !important;
  transform: translateY(-2px);
}
.sc-bill-card2.is-selected::after{
  content:"";
  position:absolute;
  inset:0;
  border-radius: 24px;
  pointer-events:none;
  background: linear-gradient(180deg, rgba(245,158,11,.10), transparent 45%);
}
.sc-bill-card2.is-selected .inline-flex{
  border-color: rgba(245,158,11,.35) !important;
  background: rgba(245,158,11,.10) !important;
}
</style>



</section>

<script>
/* =========================================================
   CALCULADORA (tu script) + Estimación estilo Massol (packs)
   - Mantiene TODO tu flujo: vivienda -> mapa -> gasto -> lead
   - Submit: lead -> loading -> result
   - Cálculo: packs + consumo por gasto (como Massol)
========================================================= */

(() => {
  const $ = (id) => document.getElementById(id);

  // =========================
  // ENTRAR / SALIR CALCULADORA
  // =========================
  const enterBtn = $('enterCalculator');
  const exitBtn  = $('exitCalculator');
  const calcSection = $('calculadora');

  const stepHousing = $('sc-step-housing');
  const stepMapWrap = $('sc-step-map');
  const stepBill    = $('sc-step-bill');

  const showCalc = () => {
    if (!calcSection) return;
    document.body.classList.add('sc-calc-full');
    calcSection.classList.remove('hidden');

    // empieza siempre en paso 1
    if (stepHousing) stepHousing.classList.remove('hidden');
    if (stepMapWrap) stepMapWrap.classList.add('hidden');
    if (stepBill)    stepBill.classList.add('hidden');

    // ✅ por si venías de lead/loading/result, los ocultamos aquí también
    const stepLead = $('sc-step-lead');
    const stepLoading = $('sc-step-loading');
    const stepResult = $('sc-step-result');
    if (stepLead) stepLead.classList.add('hidden');
    if (stepLoading) stepLoading.classList.add('hidden');
    if (stepResult) stepResult.classList.add('hidden');

    calcSection.scrollIntoView({ behavior: 'instant', block: 'start' });

    setTimeout(() => {
      if (window.__scLeafletMap) window.__scLeafletMap.invalidateSize(true);
    }, 120);
  };

  const hideCalc = () => {
    if (!calcSection) return;
    document.body.classList.remove('sc-calc-full');
    calcSection.classList.add('hidden');
    const hero = $('presentacion');
    if (hero) hero.scrollIntoView({ behavior: 'smooth', block: 'start' });
  };

  if (enterBtn) enterBtn.addEventListener('click', showCalc);
  if (exitBtn)  exitBtn.addEventListener('click', hideCalc);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && calcSection && !calcSection.classList.contains('hidden')) {
      hideCalc();
    }
  });

  // =========================
  // PASO 1: VIVIENDA
  // =========================
  const housingInput = $('sc_housing_type');
  const housingContinueBtn = $('housingContinueBtn');
  const housingHelp = $('housingHelp');

  const setHousingSelectedUI = (card) => {
    document.querySelectorAll('.sc-housing-card').forEach(c => c.classList.remove('is-selected'));
    card.classList.add('is-selected');
  };

  const enableHousingContinue = () => {
    if (!housingContinueBtn) return;
    housingContinueBtn.disabled = false;
    if (housingHelp) housingHelp.textContent = "Perfecto. Pulsa continuar.";
  };

  document.querySelectorAll('.sc-housing-card').forEach(card => {
    card.addEventListener('click', () => {
      const type = card.dataset.housing;
      if (housingInput) housingInput.value = type;
      setHousingSelectedUI(card);
      enableHousingContinue();
    });
  });

  // =========================
  // HINTS (mapa)
  // =========================
  const hintBox = $('mapHint');
  const hint = (msg) => {
    if (!hintBox) return;
    hintBox.textContent = msg;
    hintBox.classList.remove('hidden');
    clearTimeout(window.__hintT);
    window.__hintT = setTimeout(() => hintBox.classList.add('hidden'), 3500);
  };

  const gotoMapStep = () => {
    if (!housingInput || !housingInput.value) {
      if (housingHelp) housingHelp.textContent = "Selecciona una opción para continuar.";
      return;
    }
    if (stepHousing) stepHousing.classList.add('hidden');
    if (stepMapWrap) stepMapWrap.classList.remove('hidden');
    if (stepBill) stepBill.classList.add('hidden');

    stepMapWrap.scrollIntoView({ behavior: 'smooth' });

    if (window.__scLeafletMap) {
      setTimeout(() => window.__scLeafletMap.invalidateSize(true), 80);
    }
    setTimeout(() => hint("Busca tu dirección y dibuja directamente sobre el mapa."), 120);
  };

  if (housingContinueBtn) housingContinueBtn.addEventListener('click', gotoMapStep);

  // =========================
  // PASO 3: GASTO MENSUAL (con .sc-bill-card2)
  // =========================
  const billInput = $('sc_bill_monthly');
  const billContinueBtn = $('billContinueBtn');
  const billHelp = $('billHelp');

  const clearBillSelectionUI = () => {
    document.querySelectorAll('.sc-bill-card2').forEach(c => c.classList.remove('is-selected'));
  };

  const enableBillContinue = () => {
    if (!billContinueBtn) return;
    billContinueBtn.disabled = false;
    if (billHelp) billHelp.textContent = "Perfecto. Pulsa continuar.";
  };

  // tarjetas (incluye "No lo sé")
  document.querySelectorAll('.sc-bill-card2').forEach(card => {
    card.addEventListener('click', () => {
      clearBillSelectionUI();
      card.classList.add('is-selected');
      if (billInput) billInput.value = card.dataset.bill || '';
      enableBillContinue();
    });
  });

  // =========================
  // PASO FINAL: DATOS (Lead)
  // =========================
  const stepLead = $('sc-step-lead');

  const fillLeadHidden = () => {
    const setVal = (toId, fromId) => {
      const to = $(toId);
      const from = $(fromId);
      if (to && from) to.value = from.value || '';
    };

    setVal('lead_housing_type', 'sc_housing_type');
    setVal('lead_lat', 'sc_lat');
    setVal('lead_lng', 'sc_lng');
    setVal('lead_area_m2', 'sc_area_m2');
    setVal('lead_geojson', 'sc_geojson');
    setVal('lead_bill_monthly', 'sc_bill_monthly');
  };

  if (billContinueBtn) {
    billContinueBtn.addEventListener('click', () => {
      if (!billInput || !billInput.value) {
        if (billHelp) billHelp.textContent = "Selecciona una opción para continuar.";
        return;
      }

      fillLeadHidden();

      if (stepBill) stepBill.classList.add('hidden');
      if (stepLead) stepLead.classList.remove('hidden');
      stepLead.scrollIntoView({ behavior: 'smooth' });

      setTimeout(() => hint("Introduce tus datos para ver tu estimación."), 150);
    });
  }

  // =========================
  // GUARDS
  // =========================
  if (!window.L) return console.error("Leaflet no cargó");
  if (!window.turf) return console.error("Turf no cargó");
  if (!$('scMap')) return console.error("#scMap no existe");

  // =========================
  // Cargar Geoman (leaflet.pm)
  // =========================
  const GEOMAN_CSS = "https://unpkg.com/@geoman-io/leaflet-geoman-free@2.18.0/dist/leaflet-geoman.css";
  const GEOMAN_JS  = "https://unpkg.com/@geoman-io/leaflet-geoman-free@2.18.0/dist/leaflet-geoman.min.js";

  const ensureCss = (href) => {
    const exists = [...document.querySelectorAll('link[rel="stylesheet"]')]
      .some(l => (l.href || "").includes(href));
    if (exists) return;
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = href;
    document.head.appendChild(link);
  };

  const ensureScript = (src) => new Promise((resolve, reject) => {
    const exists = [...document.querySelectorAll('script')]
      .some(s => (s.src || "").includes(src));
    if (exists) return resolve();
    const s = document.createElement('script');
    s.src = src;
    s.async = true;
    s.onload = resolve;
    s.onerror = reject;
    document.head.appendChild(s);
  });

  ensureCss(GEOMAN_CSS);
  ensureScript(GEOMAN_JS).then(initMap).catch((e) => {
    console.error(e);
    hint("No se pudo cargar el modo dibujo.");
  });

  function initMap() {
    const map = L.map('scMap', { zoomControl: false }).setView([40.4168, -3.7038], 18);
    window.__scLeafletMap = map;

    L.control.zoom({ position: 'bottomright' }).addTo(map);

    const esriImagery = L.tileLayer(
      "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
      { maxZoom: 20, attribution: "Esri" }
    ).addTo(map);

    L.tileLayer(
      "https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png",
      { subdomains: "abcd", maxZoom: 20, attribution: "CARTO" }
    ).addTo(map);

    const osmFallback = L.tileLayer(
      "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      { maxZoom: 20, attribution: "© OpenStreetMap" }
    );

    let esriErrors = 0, switched = false;
    esriImagery.on("tileerror", () => {
      esriErrors += 1;
      if (esriErrors >= 6 && !switched) {
        switched = true;
        try { map.removeLayer(esriImagery); } catch {}
        osmFallback.addTo(map);
        hint("Satélite no disponible: usando mapa alternativo.");
      }
    });

    window.addEventListener("resize", () => map.invalidateSize(true));

    // UI refs
    const addr = $('addr');
    const suggest = $('suggest');
    const drawBtn = $('mapDrawBtn');
    const clearBtns = Array.from(document.querySelectorAll('.mapClearBtn'));
    const areaEl = $('mapAreaValue');

    let roofLayer = null;
    let userMarker = null;

    const setNextEnabled = (ok) => {
      const btn = $('btnNext');
      if (btn) btn.disabled = !ok;
    };
    const setClearEnabled = (enabled) => clearBtns.forEach(btn => btn.disabled = !enabled);
    const setDrawLabel = (hasPolygon) => {
      if (drawBtn) drawBtn.textContent = hasPolygon ? "✏️ Editar tejado" : "✏️ Dibujar tejado";
    };

    const clearStored = () => {
      if (areaEl) areaEl.textContent = '0';
      const areaInput = $('sc_area_m2'); if (areaInput) areaInput.value = '';
      const geoInput  = $('sc_geojson'); if (geoInput) geoInput.value = '';
      setNextEnabled(false);
    };

    const polyStyle = { color:'#2563eb', weight:3, opacity:.95, fillColor:'#3b82f6', fillOpacity:.25 };

    const updateArea = () => {
      if (!roofLayer) return clearStored();
      const gj = roofLayer.toGeoJSON();
      const area = Math.round(turf.area(gj));
      if (areaEl) areaEl.textContent = area.toLocaleString('es-ES');
      $('sc_area_m2').value = area;
      $('sc_geojson').value = JSON.stringify(gj);
      const c = roofLayer.getBounds().getCenter();
      $('sc_lat').value = c.lat;
      $('sc_lng').value = c.lng;
      setNextEnabled(area > 0);
      setClearEnabled(true);
      setDrawLabel(true);
    };

    const clearPolygon = () => {
      try { map.pm.disableDraw('Polygon'); } catch {}
      if (roofLayer) {
        try { roofLayer.pm.disable(); } catch {}
        map.removeLayer(roofLayer);
        roofLayer = null;
      }
      clearStored();
      setClearEnabled(false);
      setDrawLabel(false);
    };

    const startDrawing = () => {
      clearPolygon();
      map.pm.enableDraw('Polygon', {
        snappable: true,
        snapDistance: 15,
        allowSelfIntersection: false,
        templineStyle: { color:'#2563eb', weight:3, opacity:.7 },
        hintlineStyle: { color:'#2563eb', weight:3, opacity:.5 },
        pathOptions: polyStyle
      });
      hint("✍️ Haz clic en las esquinas del tejado. Doble clic para cerrar.");
    };

    map.on('pm:create', (e) => {
      if (e.shape !== 'Polygon') return;
      if (roofLayer) map.removeLayer(roofLayer);
      roofLayer = e.layer;
      roofLayer.setStyle(polyStyle);
      map.pm.disableDraw('Polygon');
      roofLayer.pm.enable({ allowSelfIntersection:false, snappable:true, snapDistance:15 });
      roofLayer.on('pm:edit', updateArea);
      roofLayer.on('pm:drag', updateArea);
      updateArea();
      hint("✅ Tejado marcado. Puedes ajustar los puntos.");
    });

    if (drawBtn) {
      drawBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (roofLayer) {
          try { roofLayer.pm.enable({ snappable:true, snapDistance:15, allowSelfIntersection:false }); } catch {}
          hint("✏️ Edita moviendo los puntos del polígono.");
          return;
        }
        startDrawing();
      });
    }

    clearBtns.forEach(btn => btn.addEventListener('click', (e) => {
      e.preventDefault();
      clearPolygon();
      hint("🗑️ Dibujo borrado.");
    }));

    const btnLocate = $('btnLocate');
    if (btnLocate) {
      btnLocate.addEventListener('click', () => {
        if (!navigator.geolocation) return hint("Tu navegador no soporta geolocalización");
        hint("Buscando tu ubicación…");
        navigator.geolocation.getCurrentPosition(
          (pos) => {
            const { latitude, longitude } = pos.coords;
            map.setView([latitude, longitude], 20);
            if (userMarker) map.removeLayer(userMarker);
            userMarker = L.circleMarker([latitude, longitude], { radius: 7, weight: 2 }).addTo(map);
            $('sc_lat').value = latitude;
            $('sc_lng').value = longitude;
            startDrawing();
          },
          () => hint("No se pudo obtener la ubicación (requiere HTTPS o localhost)")
        );
      });
    }

    // Nominatim ES
    let last = [];
    let deb = null;

    const hideSuggest = () => {
      if (suggest){ suggest.classList.add('hidden'); suggest.innerHTML=''; }
    };

    const showSuggest = (items) => {
      if (!suggest) return;
      if (!items.length) return hideSuggest();
      suggest.innerHTML = items.map((r, i) => `
        <button type="button" data-i="${i}" class="w-full px-4 py-3 text-left hover:bg-slate-50">
          <div class="font-bold text-slate-900">${(r.display_name || '').split(',')[0]}</div>
          <div class="text-xs text-slate-600">${r.display_name || ''}</div>
        </button>
      `).join('');
      suggest.classList.remove('hidden');
    };

    const searchES = async (q) => {
      const params = new URLSearchParams({
        format:"json", limit:"6", q,
        countrycodes:"es",
        addressdetails:"1",
        "accept-language":"es"
      });
      params.set("viewbox", "-9.5,35.5,3.5,43.9");
      params.set("bounded", "1");
      const url = `https://nominatim.openstreetmap.org/search?${params.toString()}`;
      const res = await fetch(url, { headers: { "Accept":"application/json" } });
      if (!res.ok) throw new Error(`Nominatim HTTP ${res.status}`);
      return await res.json();
    };

    if (addr) {
      addr.addEventListener('input', () => {
        clearTimeout(deb);
        const q = addr.value.trim();
        if (q.length < 3) return hideSuggest();
        deb = setTimeout(async () => {
          try {
            last = await searchES(q);
            last = (last || []).filter(x => x.address && x.address.country_code === "es");
            showSuggest(last);
          } catch (e) {
            console.error(e);
            hideSuggest();
          }
        }, 250);
      });

      addr.addEventListener('keydown', async (e) => {
        if (e.key !== 'Enter') return;
        e.preventDefault();
        const q = addr.value.trim();
        if (!q) return;
        try {
          const data = await searchES(q);
          if (!data.length) return hint("No se encontró la dirección en España");
          const r = data[0];
          map.setView([Number(r.lat), Number(r.lon)], 20);
          hideSuggest();
          startDrawing();
        } catch (err) {
          console.error(err);
          hint("Error buscando dirección");
        }
      });
    }

    if (suggest) {
      suggest.addEventListener('click', (e) => {
        const btn = e.target.closest('button[data-i]');
        if (!btn) return;
        const r = last[Number(btn.dataset.i)];
        if (!r) return;
        map.setView([Number(r.lat), Number(r.lon)], 20);
        hideSuggest();
        startDrawing();
      });
    }

    document.addEventListener('click', (e) => {
      if (e.target === addr || (suggest && suggest.contains(e.target))) return;
      hideSuggest();
    });

    // ✅ Paso 2 -> Paso 3
    const btnNext = $('btnNext');
    if (btnNext) {
      btnNext.addEventListener('click', () => {
        if (stepMapWrap) stepMapWrap.classList.add('hidden');
        if (stepBill) stepBill.classList.remove('hidden');
        stepBill.scrollIntoView({ behavior: 'smooth' });
      });
    }

    setClearEnabled(false);
    setDrawLabel(false);
    setNextEnabled(false);
  }
})();


// =========================================================
// SUBMIT LEAD -> LOADING -> RESULT  (con cálculo Massol)
// =========================================================
const stepLead    = document.getElementById('sc-step-lead');
const stepLoading = document.getElementById('sc-step-loading');
const stepResult  = document.getElementById('sc-step-result');

const leadForm    = document.getElementById('leadForm');
const progressBar = document.getElementById('scProgress');
const loadingText = document.getElementById('scLoadingText');

const money = (n) => Math.round(Number(n) || 0).toLocaleString('es-ES');

const parseBill = (v) => {
  // v: "0-50", "50-100", "100-150", "150-200", "200+", "no-se"
  if (!v) return null;
  if (v === 'no-se') return 100; // fallback
  if (v.includes('+')) return 220;
  const [a,b] = v.split('-').map(Number);
  if (!isFinite(a) || !isFinite(b)) return 100;
  return (a + b) / 2;
};

// =========================
// CONFIG estilo Massol (packs)
// =========================
const SC_CONFIG = {
  precioKwh: 0.25,
  kwhPorKwpAlAno: 1500,
  m2PorPanel: 2.4,
  kwpPorPanel: 0.64,
  packs: [
    { id: "pack-3",    potenciaKwp: 3.2,  paneles: 5,  precio: 8476,  inversor: "Inversor FOX 5 kW" },
    { id: "pack-3_8",  potenciaKwp: 3.84, paneles: 6,  precio: 8938,  inversor: "Inversor FOX 5 kW" },
    { id: "pack-4_5",  potenciaKwp: 4.48, paneles: 7,  precio: 9620,  inversor: "Inversor FOX 5 kW" },
    { id: "pack-5_1",  potenciaKwp: 5.12, paneles: 8,  precio: 9955,  inversor: "Inversor FOX 5 kW" },
    { id: "pack-6_4",  potenciaKwp: 6.4,  paneles: 10, precio: 10895, inversor: "Inversor FOX 8 kW" },
    { id: "pack-7_6",  potenciaKwp: 7.68, paneles: 12, precio: 11800, inversor: "Inversor FOX 8 kW" },
    { id: "pack-8_9",  potenciaKwp: 8.96, paneles: 14, precio: 12701, inversor: "Inversor FOX 10 kW" },
    { id: "pack-10_2", potenciaKwp: 10.24,paneles: 16, precio: 13173, inversor: "Inversor FOX 10 kW" }
  ]
};

// Estimación estilo Massol (packs + consumo por gasto)
const calcEstimation = ({ areaM2, billMonthly }) => {
  const usableM2 = Math.max(0, (Number(areaM2) || 0) * 0.70);

  const panelesMax = Math.max(0, Math.floor(usableM2 / SC_CONFIG.m2PorPanel));

  const gasto = Math.max(10, Number(billMonthly) || 100);
  const consumoMensualKwh = gasto / SC_CONFIG.precioKwh;
  const consumoAnualKwh = consumoMensualKwh * 12;

  const kwpNecesarios = consumoAnualKwh / SC_CONFIG.kwhPorKwpAlAno;
  const panelesNecesariosBase = kwpNecesarios / SC_CONFIG.kwpPorPanel;

  const panelesObjetivo = Math.max(1, Math.ceil(panelesNecesariosBase) + 2);
  const kwpObjetivo = panelesObjetivo * SC_CONFIG.kwpPorPanel;

  let packElegido = null;

  for (const pack of SC_CONFIG.packs) {
    const cabe = pack.paneles <= panelesMax;
    if (cabe && pack.potenciaKwp >= kwpObjetivo && pack.paneles >= panelesObjetivo) {
      packElegido = pack;
      break;
    }
  }

  if (!packElegido) {
    const packsQueCaben = SC_CONFIG.packs.filter(p => p.paneles <= panelesMax);
    packElegido = packsQueCaben.length ? packsQueCaben[packsQueCaben.length - 1] : SC_CONFIG.packs[0];
  }

  const produccionAnual = packElegido.potenciaKwp * SC_CONFIG.kwhPorKwpAlAno;

  let coverageRatio = produccionAnual / consumoAnualKwh;
  if (!isFinite(coverageRatio) || coverageRatio <= 0) coverageRatio = 0.6;
  coverageRatio = Math.min(0.9, coverageRatio);

  const annualSpend = gasto * 12;
  const factorAhorro = 0.70;
  const saveYear = Math.round(annualSpend * coverageRatio * factorAhorro);

  const priceMid = packElegido.precio;
  const priceMin = Math.round(priceMid * 0.92);
  const priceMax = Math.round(priceMid * 1.12);

  const kwpMostrar = Math.round(packElegido.potenciaKwp * 10) / 10;

  return {
    kwp: kwpMostrar,
    panels: packElegido.paneles,
    priceMin,
    priceMax,
    saveYear,
    coveragePct: Math.round(coverageRatio * 100),
    packId: packElegido.id,
    inverter: packElegido.inversor || ""
  };
};

const setProgress = (pct, msg) => {
  if (progressBar) progressBar.style.width = `${pct}%`;
  if (loadingText && msg) loadingText.textContent = msg;
};

// ✅ helper para ocultar todo lo anterior cuando estás en loading/result
const hideAllStepsBefore = () => {
  const ids = ['sc-step-housing','sc-step-map','sc-step-bill','sc-step-lead'];
  ids.forEach(id => document.getElementById(id)?.classList.add('hidden'));
};

if (leadForm) {
  leadForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    // mostrar loading y ocultar todo lo anterior (evita “ver el paso anterior arriba”)
    hideAllStepsBefore();
    if (stepResult) stepResult.classList.add('hidden');
    if (stepLoading) stepLoading.classList.remove('hidden');
    stepLoading.scrollIntoView({ behavior: 'smooth' });

    setProgress(18, 'Enviando datos…');

    try {
      const formData = new FormData(leadForm);

      const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

      await fetch(leadForm.action || window.location.href, {
        method: 'POST',
        headers: csrf ? { 'X-CSRF-TOKEN': csrf } : {},
        body: formData
      });

      setProgress(55, 'Calculando estimación…');
      await new Promise(r => setTimeout(r, 650));

      setProgress(85, 'Preparando resultados…');

      const areaM2 = Number(document.getElementById('sc_area_m2')?.value || 0);
      const billMonthly = parseBill(document.getElementById('sc_bill_monthly')?.value);

      const out = calcEstimation({ areaM2, billMonthly });

      // pintar resultados
      const elKwp = document.getElementById('resKwp');
      const elPanels = document.getElementById('resPanels');
      const elMin = document.getElementById('resPriceMin');
      const elMax = document.getElementById('resPriceMax');
      const elSave = document.getElementById('resSave');

      if (elKwp)   elKwp.textContent = out.kwp;
      if (elPanels)elPanels.textContent = out.panels;
      if (elMin)   elMin.textContent = money(out.priceMin);
      if (elMax)   elMax.textContent = money(out.priceMax);
      if (elSave)  elSave.textContent = money(out.saveYear);

      // opcionales (si existen en tu HTML)
      const elCoverage = document.getElementById('resCoverage');
      const elInverter = document.getElementById('resInverter');
      if (elCoverage) elCoverage.textContent = out.coveragePct;
      if (elInverter) elInverter.textContent = out.inverter;

      setProgress(100, 'Listo ✅');
      await new Promise(r => setTimeout(r, 300));

      if (stepLoading) stepLoading.classList.add('hidden');
      if (stepResult) stepResult.classList.remove('hidden');
      stepResult.scrollIntoView({ behavior: 'smooth' });

    } catch (err) {
      console.error(err);
      if (stepLoading) stepLoading.classList.add('hidden');
      if (stepLead) stepLead.classList.remove('hidden');
      alert('No se pudo enviar. Revisa tu conexión e inténtalo de nuevo.');
    }
  });
}
</script>



</body>
</html>
