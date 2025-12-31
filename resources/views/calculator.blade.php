<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calculadora de placas solares | Precio orientativo en 1 minuto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Calcula el precio orientativo de tu instalación de placas solares en 1 minuto. Estimación según consumo, tejado, orientación, superficie y provincia.">

  <link rel="stylesheet" href="{{ asset('css/calculadora.css') }}?v={{ time() }}">
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- FAQ Schema (SEO) --}}
  <script type="application/ld+json">
  @verbatim
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "¿Cómo calculamos el precio de tus placas solares?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Lo estimamos a partir de tu consumo, orientación del tejado, superficie disponible y provincia, cruzándolo con costes habituales de equipos e instalación para obtener un presupuesto orientativo."
        }
      },
      {
        "@type": "Question",
        "name": "¿Qué incluye el precio orientativo de la instalación?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Incluye paneles, inversor, estructura, cableado y mano de obra de una instalación completa, como estimación inicial."
        }
      }
    ]
  }
  @endverbatim
  </script>
</head>

  <body class="min-h-screen bg-slate-50 text-slate-900">
  <a class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:rounded-xl focus:bg-white focus:px-4 focus:py-2 focus:text-slate-900 focus:shadow-lg" href="#calculadora">Saltar a la calculadora</a>

  <header class="sticky top-0 z-40 border-b border-slate-200/70 bg-white/80 backdrop-blur">
    <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-4 sm:flex-row sm:items-center sm:justify-between">
      <div class="flex items-center gap-3">
        <div class="grid h-10 w-10 place-items-center rounded-2xl bg-white/10 text-xl shadow-[0_12px_40px_-30px_rgba(250,204,21,.8)]" aria-hidden="true">☀️</div>
        <div>
          <div class="text-base font-semibold tracking-tight">Calculadora Solar</div>
          <div class="text-sm text-slate-300">Estimación orientativa en 1 minuto</div>
        </div>
      </div>

      <div class="flex flex-wrap gap-2" aria-label="Beneficios rápidos">
        <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">🔒 Sin compromiso</span>
        <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">📍 Ajuste por provincia</span>
        <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">⚡ Resultado al instante</span>
      </div>
    </div>
  </header>

  <main class="relative">
    {{-- HERO --}}
    <section class="relative overflow-hidden" aria-labelledby="hero-title">
  <!-- Fondo: claro pero con carácter -->
  <div class="pointer-events-none absolute inset-0 -z-10">
    <div class="absolute inset-0 bg-gradient-to-b from-amber-50 via-white to-emerald-50"></div>
    <div class="absolute -top-48 left-[-120px] h-[520px] w-[520px] rounded-full bg-amber-200/40 blur-3xl"></div>
    <div class="absolute -bottom-52 right-[-140px] h-[560px] w-[560px] rounded-full bg-emerald-200/40 blur-3xl"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_15%,rgba(250,204,21,.18),transparent_40%),radial-gradient(circle_at_85%_30%,rgba(16,185,129,.14),transparent_45%)]"></div>
  </div>

  <div class="mx-auto grid max-w-6xl grid-cols-1 gap-8 px-4 py-12 lg:grid-cols-12 lg:py-16">
    <!-- Columna izquierda -->
    <div class="lg:col-span-7">
      <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/70 px-3 py-1 text-xs font-medium text-slate-700 shadow-sm">
        Autoconsumo · Placas solares · Presupuesto orientativo
      </div>

      <h1 id="hero-title"
        class="mt-5 text-4xl font-semibold leading-tight tracking-tight text-slate-900 sm:text-5xl">
      Calcula el precio de tus placas solares
      <span class="font-semibold text-transparent bg-clip-text bg-gradient-to-r from-amber-500 via-yellow-500 to-emerald-500">
        en 1 minuto
      </span>
      </h1>

      <p class="mt-5 max-w-xl text-base text-slate-700 sm:text-lg">
        Responde a unas preguntas y obtén una estimación orientativa de
        <strong class="text-slate-900">potencia</strong>, <strong class="text-slate-900">presupuesto</strong> y <strong class="text-slate-900">ahorro anual</strong>.
      </p>

      <!-- Píldoras: más legibles -->
      <div class="mt-6 flex flex-wrap gap-2" aria-label="Puntos clave">
        <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/70 px-3 py-1 text-xs font-semibold text-slate-700 shadow-sm">
          ⏱️ Rápido
        </span>
        <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/70 px-3 py-1 text-xs font-semibold text-slate-700 shadow-sm">
          ✅ Datos mínimos
        </span>
        <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/70 px-3 py-1 text-xs font-semibold text-slate-700 shadow-sm">
          📩 Recibe el resumen
        </span>
        <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/70 px-3 py-1 text-xs font-semibold text-slate-700 shadow-sm">
          🔒 Sin compromiso
        </span>
      </div>

      <!-- Botones: más “pro” -->
      <div class="mt-7 flex flex-wrap items-center gap-3">
        <a class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-extrabold text-white shadow-lg shadow-slate-900/10 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900/30"
           href="#calculadora">Empezar cálculo</a>

        <a class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white/70 px-6 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-amber-500/20"
           href="#seo">Ver información y FAQ</a>
      </div>

      <div class="mt-4 text-xs text-slate-600">
        *Cifra orientativa. El precio final se ajusta con un estudio técnico.
      </div>
    </div>

    <!-- Tarjeta derecha -->
    <aside class="lg:col-span-5" aria-label="Resumen de lo que obtendrás">
      <div class="rounded-3xl border border-slate-200 bg-white/80 p-6 shadow-[0_20px_60px_-40px_rgba(15,23,42,.35)] backdrop-blur">
        <div class="flex items-center justify-between gap-3">
          <div class="text-sm font-extrabold text-slate-900">Lo que obtendrás</div>
          <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700">
            ⭐ Estimación rápida
          </span>
        </div>

        <!-- Stats -->
        <div class="mt-5 grid grid-cols-3 gap-3">
          <div class="rounded-2xl border border-slate-200 bg-white p-3">
            <div class="text-lg font-black text-slate-900">kWp</div>
            <div class="mt-1 text-xs font-medium text-slate-600">Potencia recomendada</div>
          </div>
          <div class="rounded-2xl border border-slate-200 bg-white p-3">
            <div class="text-lg font-black text-slate-900">€</div>
            <div class="mt-1 text-xs font-medium text-slate-600">Presupuesto orientativo</div>
          </div>
          <div class="rounded-2xl border border-slate-200 bg-white p-3">
            <div class="text-lg font-black text-slate-900">€/año</div>
            <div class="mt-1 text-xs font-medium text-slate-600">Ahorro estimado</div>
          </div>
        </div>

        <!-- Puntos: ya no bullets “flojos” -->
        <div class="mt-5 grid gap-3 text-sm">
          <div class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white p-3">
            <div class="grid h-10 w-10 place-items-center rounded-xl bg-amber-50 text-lg" aria-hidden="true">🏠</div>
            <div>
              <div class="font-extrabold text-slate-900">Vivienda y tejado</div>
              <div class="text-slate-600">Tipo de vivienda + superficie útil</div>
            </div>
          </div>

          <div class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white p-3">
            <div class="grid h-10 w-10 place-items-center rounded-xl bg-emerald-50 text-lg" aria-hidden="true">🧭</div>
            <div>
              <div class="font-extrabold text-slate-900">Orientación</div>
              <div class="text-slate-600">Ajusta producción y ahorro</div>
            </div>
          </div>

          <div class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white p-3">
            <div class="grid h-10 w-10 place-items-center rounded-xl bg-sky-50 text-lg" aria-hidden="true">⚡</div>
            <div>
              <div class="font-extrabold text-slate-900">Consumo</div>
              <div class="text-slate-600">Factura mensual o kWh/año</div>
            </div>
          </div>

          <div class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white p-3">
            <div class="grid h-10 w-10 place-items-center rounded-xl bg-indigo-50 text-lg" aria-hidden="true">📍</div>
            <div>
              <div class="font-extrabold text-slate-900">Provincia</div>
              <div class="text-slate-600">Ajuste por radiación media</div>
            </div>
          </div>
        </div>

        <div class="mt-5 flex flex-wrap gap-2">
          <span class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-semibold text-slate-700">📈 Más datos = más precisión</span>
          <span class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-semibold text-slate-700">⚡ Resultado al instante</span>
        </div>
      </div>
    </aside>
  </div>

  <div class="mx-auto max-w-6xl px-4 pb-8">
    <div class="flex items-center justify-center gap-2 text-xs font-medium text-slate-500" aria-hidden="true">
      <span>Desliza para empezar</span>
      <span class="translate-y-[1px]">↓</span>
    </div>
  </div>
</section>

    {{-- CALCULADORA --}}

    <section id="calculadora"
  class="scroll-mt-24 py-14 bg-gradient-to-b from-white via-slate-50 to-white"
  aria-label="Calculadora">

  <!-- Mini CSS imprescindible para el wizard -->
  <style>
    .sc5-panel { display:none; }
    .sc5-panel.active { display:block; }
    #sc-toast { opacity:0; transform: translate(-50%, 10px); pointer-events:none; transition: .2s ease; }
    #sc-toast.show { opacity:1; transform: translate(-50%, 0); }
    .sc5-opt.active { outline: 2px solid rgba(253, 224, 71, .9); outline-offset: 2px; }
  </style>

  <div class="mx-auto max-w-6xl px-4">
    <div class="mb-8">
      <h2 class="text-2xl font-semibold tracking-tight text-slate-900 sm:text-3xl">
        Calculadora de placas solares
      </h2>
      <p class="mt-2 text-sm text-slate-600">
        Responde a unas preguntas rápidas y obtén un precio orientativo al instante.
      </p>
    </div>

    @if ($errors->any())
      <section class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4" aria-label="Errores de formulario">
        <div class="text-sm font-semibold text-red-700">Revisa estos campos</div>
        <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700/90">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </section>
    @endif

    <!-- WIZARD centrado (sin que nada “empuje” el layout) -->
    <div class="grid grid-cols-1 gap-6">
      <div id="wizard-card">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_18px_50px_-35px_rgba(15,23,42,.25)]">
          <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
            <div>
              <div class="text-base font-semibold text-slate-900">Tu cálculo</div>
              <div class="text-sm text-slate-600">Paso a paso · resultado orientativo</div>
            </div>

            <button type="button"
              class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-800 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-yellow-300/60"
              id="sc-reset"
              aria-label="Reiniciar formulario">Reiniciar</button>
          </div>

          <form id="solar-form" method="POST" action="{{ route('calculator.store') }}" class="mt-5">
            @csrf

            <input type="hidden" name="calc_kwp" id="calc_kwp" value="">
            <input type="hidden" name="calc_presupuesto" id="calc_presupuesto" value="">
            <input type="hidden" name="calc_paneles" id="calc_paneles" value="">
            <input type="hidden" name="calc_ahorro_anual" id="calc_ahorro_anual" value="">

            <input type="hidden" name="utm_source" id="utm_source" value="">
            <input type="hidden" name="utm_medium" id="utm_medium" value="">
            <input type="hidden" name="utm_campaign" id="utm_campaign" value="">
            <input type="hidden" name="utm_content" id="utm_content" value="">
            <input type="hidden" name="utm_term" id="utm_term" value="">

            <input type="hidden" name="tipo_vivienda" id="tipo_vivienda" value="{{ old('tipo_vivienda','unifamiliar') }}">
            <input type="hidden" name="orientacion" id="orientacion" value="{{ old('orientacion','sur') }}">
            <input type="hidden" name="consumo_modo" id="consumo_modo" value="{{ old('consumo_modo','') }}">

            <!-- PROGRESO -->
            <div class="mt-5 rounded-2xl border border-slate-200 bg-slate-50 p-4" aria-label="Progreso">
              <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                <div class="text-sm font-semibold text-slate-900" id="sc-steptext">Paso 1 de 10</div>
                <div class="text-xs text-slate-600">Tip: puedes clicar una opción para avanzar</div>
              </div>

              <div class="mt-3 h-2 w-full rounded-full bg-slate-200" aria-hidden="true">
                <div class="h-2 rounded-full bg-gradient-to-r from-yellow-400 via-yellow-300 to-emerald-300 transition-[width] duration-300"
                     id="sc-bar-fill" style="width:0%"></div>
              </div>
            </div>

            <div class="mt-6">

              <!-- STEP 1 -->
              <section class="sc5-panel active" data-step="1">
                <h3 class="text-lg font-semibold text-slate-900">¿Qué tipo de vivienda es?</h3>
                <p class="mt-1 text-sm text-slate-600">Selecciona una opción.</p>

                <div class="sc5-options mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2" data-pick="tipo_vivienda">
                  <button type="button"
                    class="sc5-opt rounded-2xl border border-slate-200 bg-white p-4 text-left shadow-sm hover:border-slate-300 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60"
                    data-value="casa">
                    <span class="block text-sm font-semibold text-slate-900">🏡 Casa</span>
                    <span class="mt-1 block text-xs text-slate-600">Unifamiliar / chalet</span>
                  </button>

                  <button type="button"
                    class="sc5-opt rounded-2xl border border-slate-200 bg-white p-4 text-left shadow-sm hover:border-slate-300 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60"
                    data-value="adosado">
                    <span class="block text-sm font-semibold text-slate-900">🏘️ Adosado</span>
                    <span class="mt-1 block text-xs text-slate-600">Adosado / pareado</span>
                  </button>

                  <button type="button"
                    class="sc5-opt rounded-2xl border border-slate-200 bg-white p-4 text-left shadow-sm hover:border-slate-300 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60"
                    data-value="piso">
                    <span class="block text-sm font-semibold text-slate-900">🏢 Piso / Ático</span>
                    <span class="mt-1 block text-xs text-slate-600">En edificio o comunidad</span>
                  </button>

                  <button type="button"
                    class="sc5-opt rounded-2xl border border-slate-200 bg-white p-4 text-left shadow-sm hover:border-slate-300 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60"
                    data-value="negocio">
                    <span class="block text-sm font-semibold text-slate-900">🏭 Negocio</span>
                    <span class="mt-1 block text-xs text-slate-600">Local / nave / empresa</span>
                  </button>
                </div>

                <div class="mt-6 flex items-center justify-between gap-3">
                  <button type="button"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-800 opacity-60"
                    disabled>Atrás</button>

                  <button type="button"
                    class="inline-flex items-center justify-center rounded-xl bg-yellow-400 px-5 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-300/70"
                    data-next>Siguiente</button>
                </div>
              </section>

              <!-- STEP 2 -->
              <section class="sc5-panel" data-step="2">
                <h3 class="text-lg font-semibold text-slate-900">¿Cuánta superficie útil de tejado tienes?</h3>
                <p class="mt-1 text-sm text-slate-600">Aproximado. Si no lo sabes, pon una estimación.</p>

                <label class="mt-4 block">
                  <span class="text-sm font-semibold text-slate-900">Superficie útil (m²)</span>
                  <input type="number" id="superficie_m2" name="superficie_m2" min="5" max="500" step="1"
                    placeholder="Ej: 60" value="{{ old('superficie_m2') }}"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-300/60">
                </label>

                <div class="mt-6 flex items-center justify-between gap-3">
                  <button type="button"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/40"
                    data-prev>Atrás</button>

                  <button type="button"
                    class="inline-flex items-center justify-center rounded-xl bg-yellow-400 px-5 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-300/70"
                    data-next>Siguiente</button>
                </div>
              </section>

              <!-- STEP 3 -->
              <section class="sc5-panel" data-step="3">
                <h3 class="text-lg font-semibold text-slate-900">¿Cuál es la orientación principal del tejado?</h3>
                <p class="mt-1 text-sm text-slate-600">Selecciona una opción.</p>

                <div class="sc5-options mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3" data-pick="orientacion">
                  <button type="button" class="sc5-opt rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60" data-value="sur">Sur</button>
                  <button type="button" class="sc5-opt rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60" data-value="sureste">Sureste</button>
                  <button type="button" class="sc5-opt rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60" data-value="suroeste">Suroeste</button>
                  <button type="button" class="sc5-opt rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60" data-value="este">Este</button>
                  <button type="button" class="sc5-opt rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60" data-value="oeste">Oeste</button>
                  <button type="button" class="sc5-opt rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60" data-value="norte">Norte</button>
                </div>

                <div class="mt-6 flex items-center justify-between gap-3">
                  <button type="button" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/40" data-prev>Atrás</button>
                  <button type="button" class="inline-flex items-center justify-center rounded-xl bg-yellow-400 px-5 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-300/70" data-next>Siguiente</button>
                </div>
              </section>

              <!-- STEP 4 -->
              <section class="sc5-panel" data-step="4">
                <h3 class="text-lg font-semibold text-slate-900">¿Cómo prefieres indicar tu consumo?</h3>
                <p class="mt-1 text-sm text-slate-600">Elige una opción.</p>

                <div class="sc5-options mt-4 grid grid-cols-1 gap-3" data-pick="consumo_modo">
                  <button type="button" class="sc5-opt rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60" data-value="factura">Por importe de factura</button>
                  <button type="button" class="sc5-opt rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/60" data-value="kwh">Por kWh al año</button>
                </div>

                <div class="mt-6 flex items-center justify-between gap-3">
                  <button type="button" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/40" data-prev>Atrás</button>
                  <button type="button" class="inline-flex items-center justify-center rounded-xl bg-yellow-400 px-5 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-300/70" data-next>Siguiente</button>
                </div>
              </section>

              <!-- STEP 5 -->
              <section class="sc5-panel" data-step="5">
                <h3 class="text-lg font-semibold text-slate-900" id="sc-consumo-title">Indica tu consumo</h3>
                <p class="mt-1 text-sm text-slate-600" id="sc-consumo-help">Rellena el dato.</p>

                <label class="mt-4 block" id="sc-field-factura">
                  <span class="text-sm font-semibold text-slate-900">Factura mensual (€)</span>
                  <input type="number" id="factura_mensual" name="factura_mensual" min="0" step="1"
                    placeholder="Ej: 85" value="{{ old('factura_mensual') }}"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-300/60">
                </label>

                <label class="mt-4 block" id="sc-field-kwh">
                  <span class="text-sm font-semibold text-slate-900">Consumo anual (kWh)</span>
                  <input type="number" id="consumo_anual" name="consumo_anual" min="0" step="100"
                    placeholder="Ej: 4200" value="{{ old('consumo_anual') }}"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-300/60">
                </label>

                <p class="mt-3 text-sm text-slate-600"><em>Con una cifra aproximada ya podemos estimar un presupuesto orientativo.</em></p>

                <div class="mt-6 flex items-center justify-between gap-3">
                  <button type="button" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/40" data-prev>Atrás</button>
                  <button type="button" class="inline-flex items-center justify-center rounded-xl bg-yellow-400 px-5 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-300/70" data-next>Siguiente</button>
                </div>
              </section>

              <!-- STEP 6 -->
              <section class="sc5-panel" data-step="6">
                <h3 class="text-lg font-semibold text-slate-900">Provincia de la vivienda</h3>
                <p class="mt-1 text-sm text-slate-600">Nos permite ajustar la producción media.</p>

                <label class="mt-4 block">
                  <span class="text-sm font-semibold text-slate-900">Provincia</span>
                  <input type="text" id="provincia" name="provincia" placeholder="Ej: Madrid" value="{{ old('provincia') }}"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-300/60">
                </label>

                <div class="mt-6 flex items-center justify-between gap-3">
                  <button type="button" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/40" data-prev>Atrás</button>
                  <button type="button" class="inline-flex items-center justify-center rounded-xl bg-yellow-400 px-5 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-300/70" data-next>Siguiente</button>
                </div>
              </section>

              <!-- STEP 7 -->
              <section class="sc5-panel" data-step="7">
                <h3 class="text-lg font-semibold text-slate-900">Datos de contacto</h3>
                <p class="mt-1 text-sm text-slate-600">Déjanos tu nombre para identificar tu solicitud.</p>

                <label class="mt-4 block">
                  <span class="text-sm font-semibold text-slate-900">Nombre</span>
                  <input type="text" id="nombre" name="nombre" required autocomplete="name"
                    placeholder="Ej: Laura" value="{{ old('nombre') }}"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-300/60">
                </label>

                <div class="mt-6 flex items-center justify-between gap-3">
                  <button type="button" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/40" data-prev>Atrás</button>
                  <button type="button" class="inline-flex items-center justify-center rounded-xl bg-yellow-400 px-5 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-300/70" data-next>Siguiente</button>
                </div>
              </section>

              <!-- STEP 8 -->
              <section class="sc5-panel" data-step="8">
                <h3 class="text-lg font-semibold text-slate-900">Teléfono</h3>
                <p class="mt-1 text-sm text-slate-600">Para contactarte si quieres afinar el estudio.</p>

                <label class="mt-4 block">
                  <span class="text-sm font-semibold text-slate-900">Teléfono</span>
                  <input type="tel" id="telefono" name="telefono" required inputmode="tel" autocomplete="tel"
                    placeholder="Ej: 6XX XXX XXX" value="{{ old('telefono') }}"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-300/60">
                </label>

                <div class="mt-6 flex items-center justify-between gap-3">
                  <button type="button" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/40" data-prev>Atrás</button>
                  <button type="button" class="inline-flex items-center justify-center rounded-xl bg-yellow-400 px-5 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-300/70" data-next>Siguiente</button>
                </div>
              </section>

              <!-- STEP 9 -->
              <section class="sc5-panel" data-step="9">
                <h3 class="text-lg font-semibold text-slate-900">Email</h3>
                <p class="mt-1 text-sm text-slate-600">Te enviaremos el resumen si lo necesitas.</p>

                <label class="mt-4 block">
                  <span class="text-sm font-semibold text-slate-900">Email</span>
                  <input type="email" id="email" name="email" required autocomplete="email"
                    placeholder="Ej: nombre@correo.com" value="{{ old('email') }}"
                    class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-300/60">
                </label>

                <label class="mt-4 flex items-start gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                  <input type="checkbox" name="consent_contacto" required class="mt-1 h-4 w-4 rounded border-slate-300 bg-white">
                  <span class="text-sm text-slate-700">Acepto que me contactéis para recibir información sobre la instalación fotovoltaica.</span>
                </label>

                <p class="mt-3 text-xs text-slate-500">Tus datos se usarán solo para atender tu solicitud, según la política de privacidad.</p>

                <div class="mt-6 flex items-center justify-between gap-3">
                  <button type="button" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/40" data-prev>Atrás</button>
                  <button type="button" class="inline-flex items-center justify-center rounded-xl bg-yellow-400 px-5 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-300/70" data-next>Ver resultado</button>
                </div>
              </section>

              <!-- STEP 10 -->
              <section class="sc5-panel" data-step="10">
                <h3 class="text-lg font-semibold text-slate-900">Tu resultado orientativo</h3>
                <p class="mt-1 text-sm text-slate-600">Estimación basada en los datos introducidos.</p>

                <div class="mt-4 rounded-3xl border border-slate-200 bg-slate-50 p-5">
                  <div class="text-base font-semibold text-slate-900" id="result-titulo">Instalación estimada: — kWp</div>
                  <div class="mt-1 text-sm text-slate-700" id="result-precio">Presupuesto orientativo: — €</div>

                  <div class="mt-3 flex flex-wrap gap-2">
                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs text-slate-700" id="result-placas">— paneles</span>
                    <span class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-xs text-slate-700" id="result-ahorro">Ahorro estimado: — €/año</span>
                  </div>

                  <div class="mt-3 text-xs text-slate-500">Cifra orientativa. El precio final se ajusta con un estudio técnico.</div>
                </div>

                <div class="mt-6 flex items-center justify-between gap-3">
                  <button type="button" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-800 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-300/40" data-prev>Atrás</button>
                  <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-yellow-400 px-5 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-300/70">
                    Enviar solicitud
                  </button>
                </div>
              </section>

            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- CONSEJOS integrados (mismo estilo que la calculadora, no “otro módulo”) -->
    <section class="mt-6" aria-label="Consejos rápidos">
      <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_18px_50px_-35px_rgba(15,23,42,.18)]">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
          <div>
            <div class="text-base font-semibold text-slate-900">Consejos rápidos</div>
            <div class="text-sm text-slate-600">Para que el resultado sea más preciso</div>
          </div>
          <div class="text-xs text-slate-500">*Resultado orientativo.</div>
        </div>

        <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
          <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-start gap-3">
              <div class="grid h-10 w-10 place-items-center rounded-2xl bg-slate-50 text-lg" aria-hidden="true">📐</div>
              <div>
                <div class="text-sm font-semibold text-slate-900">Superficie útil</div>
                <div class="mt-1 text-sm text-slate-600">Cuenta solo la zona libre de sombras y obstáculos.</div>
              </div>
            </div>
          </div>

          <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-start gap-3">
              <div class="grid h-10 w-10 place-items-center rounded-2xl bg-slate-50 text-lg" aria-hidden="true">🧭</div>
              <div>
                <div class="text-sm font-semibold text-slate-900">Orientación</div>
                <div class="mt-1 text-sm text-slate-600">Sur suele rendir más que Este/Oeste.</div>
              </div>
            </div>
          </div>

          <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-start gap-3">
              <div class="grid h-10 w-10 place-items-center rounded-2xl bg-slate-50 text-lg" aria-hidden="true">⚡</div>
              <div>
                <div class="text-sm font-semibold text-slate-900">Consumo</div>
                <div class="mt-1 text-sm text-slate-600">Con una aproximación ya sirve para estimar.</div>
              </div>
            </div>
          </div>

          <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-start gap-3">
              <div class="grid h-10 w-10 place-items-center rounded-2xl bg-slate-50 text-lg" aria-hidden="true">📍</div>
              <div>
                <div class="text-sm font-semibold text-slate-900">Provincia</div>
                <div class="mt-1 text-sm text-slate-600">Ajusta la producción media de tu zona.</div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

  </div>
</section>

<!-- TOAST -->
<div class="fixed bottom-4 left-1/2 z-50 -translate-x-1/2 rounded-2xl border border-slate-200 bg-white/95 px-4 py-3 text-sm text-slate-900 shadow-lg backdrop-blur"
     id="sc-toast" role="status" aria-live="polite"></div>



 
      
    {{-- SEO (MODO CLARO para lectura y confianza) --}}
    <section id="seo" class="py-14 text-slate-900 sc5-seo-surface" aria-label="Preguntas frecuentes y contenido informativo">
      <div class="mx-auto max-w-6xl px-4">
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-[0_20px_60px_-40px_rgba(15,23,42,.35)]">
          <div class="mb-6">
            <h2 class="text-2xl font-semibold tracking-tight">Preguntas frecuentes sobre el precio de placas solares</h2>
            <p class="mt-2 text-sm text-slate-600">
              Haz clic en cada apartado para ver la información. Todo el contenido está disponible y organizado para que sea más fácil de leer.
            </p>
          </div>

          <div class="space-y-3" role="list">

            <details class="group rounded-2xl border border-slate-200 bg-white p-4">
              <summary class="cursor-pointer list-none text-sm font-semibold text-slate-900 marker:hidden">
                <div class="flex items-center justify-between gap-3">
                  <span>¿Cómo calculamos el precio de tus placas solares?</span>
                  <span class="text-slate-500 group-open:rotate-180 transition-transform">⌄</span>
                </div>
              </summary>
              <div class="mt-3 space-y-3 text-sm text-slate-700">
                <p>El precio de tus placas solares lo calculamos a partir de tu consumo de luz, la orientación de tu tejado y tipo de residencia. Nuestra calculadora cruza estos datos con el coste actual de los equipos, la mano de obra... Así obtenemos un precio orientativo de instalación de placas solares ajustado a tu vivienda.</p>

                <h3 class="text-base font-semibold text-slate-900">Qué datos te pedimos para hacer el presupuesto</h3>
                <p>Para calcular el precio de las placas solares te pedimos sólo los datos imprescindibles: tu consumo medio mensual, el tipo de vivienda, la orientación de tu tejado... Con esta información podemos estimar cuántos paneles necesitas, la potencia ideal de la instalación y un rango de precios realista para tu caso.</p>

                <h3 class="text-base font-semibold text-slate-900">Qué incluye el precio orientativo de la instalación</h3>
                <p>El precio orientativo de la instalación de placas solares incluye los paneles, inversor, estructura, cableado, mano de obra de una instalación completa. De esta forma sabes desde el principio cuánto cuesta poner placas solares.</p>
              </div>
            </details>

            <details class="group rounded-2xl border border-slate-200 bg-white p-4">
              <summary class="cursor-pointer list-none text-sm font-semibold text-slate-900 marker:hidden">
                <div class="flex items-center justify-between gap-3">
                  <span>Factores que influyen en el precio de las placas solares</span>
                  <span class="text-slate-500 group-open:rotate-180 transition-transform">⌄</span>
                </div>
              </summary>
              <div class="mt-3 space-y-3 text-sm text-slate-700">
                <p>El precio de las placas solares no es igual para todas las viviendas. Depende del consumo eléctrico, el espacio disponible en el tejado y si añades baterías u otros extras. Conocer estos factores te ayuda a entender por qué una instalación puede ser más barata o más cara y a decidir qué opción te conviene más.</p>

                <h3 class="text-base font-semibold text-slate-900">¿Cómo afectan tu consumo de luz y la potencia que necesitas al precio?</h3>
                <p>Cuanto mayor es tu consumo de luz, mayor potencia debe tener la instalación y, por tanto, sube el precio de las placas solares. La clave está en dimensionar bien: una instalación demasiado pequeña se queda corta, y una sobredimensionada encarece la inversión sin necesidad. Por eso ajustamos la potencia a tu consumo real para equilibrar coste y ahorro.</p>

                <h3 class="text-base font-semibold text-slate-900">¿Cómo afectan el tipo de tejado, orientación y sombras?</h3>
                <p>El tipo de tejado, su orientación y las sombras cercanas influyen directamente en el rendimiento de las placas solares y en el precio de la instalación. Un tejado sencillo, bien orientado y sin sombras abarata la estructura y la mano de obra. En cambio, tejados complejos, con muchas aguas o con obstáculos pueden requerir más material y tiempo de montaje.</p>

                <h3 class="text-base font-semibold text-slate-900">Con o sin baterías, aerotermia y otros extras</h3>
                <p>Añadir baterías solares, aerotermia u otros extras aumenta el precio inicial de la instalación, pero también mejora mucho el confort y el ahorro a largo plazo. Las baterías te permiten aprovechar más la energía de tus placas solares durante cortes de la red eléctrica o durante la noche, y la aerotermia reduce el gasto en calefacción y agua caliente. Nuestra calculadora te muestra cómo cada combinación encaja mejor con tu vivienda y tu bolsillo.</p>
              </div>
            </details>

            <details class="group rounded-2xl border border-slate-200 bg-white p-4">
              <summary class="cursor-pointer list-none text-sm font-semibold text-slate-900 marker:hidden">
                <div class="flex items-center justify-between gap-3">
                  <span>Ejemplos de precio de instalaciones de placas solares</span>
                  <span class="text-slate-500 group-open:rotate-180 transition-transform">⌄</span>
                </div>
              </summary>
              <div class="mt-3 space-y-3 text-sm text-slate-700">
                <p>Para que te hagas una idea clara, te mostramos ejemplos reales de precio de instalaciones de placas solares según el tipo de vivienda. Así puedes comparar tu caso con otros parecidos y ver un rango de inversión habitual. Recuerda que se trata de precios orientativos, pero muy útiles para decidir si dar el paso al autoconsumo.</p>

                <h3 class="text-base font-semibold text-slate-900">Precio de placas solares para una casa unifamiliar</h3>
                <p>En una casa unifamiliar, el precio de las placas solares suele ser más competitivo porque hay más superficie disponible y el tejado suele ser propio. Las instalaciones típicas son suficientes para cubrir buena parte del consumo de una familia. La inversión se amortiza en pocos años gracias al ahorro mensual en la factura.</p>

                <h3 class="text-base font-semibold text-slate-900">Precio de placas solares para un piso o ático</h3>
                <p>En pisos o áticos, el precio de las placas solares depende de si se trata de una instalación individual en la azotea o de un proyecto compartido en la comunidad. El espacio suele ser más limitado, por lo que se buscan soluciones muy eficientes. Aun así, es posible reducir una parte importante de la factura con una instalación bien diseñada.</p>

                <h3 class="text-base font-semibold text-slate-900">Precio de placas solares para negocio o local comercial</h3>
                <p>En negocios y locales comerciales, el precio de la instalación de placas solares está muy ligado a los horarios de consumo. Como muchas empresas consumen más durante el día, aprovechan mejor la producción solar y recuperan la inversión antes. Una buena instalación fotovoltaica puede recortar de forma notable los costes fijos de electricidad.</p>
              </div>
            </details>

            <details class="group rounded-2xl border border-slate-200 bg-white p-4">
              <summary class="cursor-pointer list-none text-sm font-semibold text-slate-900 marker:hidden">
                <div class="flex items-center justify-between gap-3">
                  <span>¿Es rentable el precio de las placas solares en tu caso?</span>
                  <span class="text-slate-500 group-open:rotate-180 transition-transform">⌄</span>
                </div>
              </summary>
              <div class="mt-3 space-y-3 text-sm text-slate-700">
                <p>La verdadera pregunta no es sólo cuánto cuestan las placas solares, sino si son rentables para ti. Analizamos tu consumo, tu tarifa eléctrica y creamos el precio estimado de la instalación para calcular el tiempo de amortización. Así sabrás en cuántos años recuperarás la inversión y cuánto podrías ahorrar a partir de entonces.</p>

                <h3 class="text-base font-semibold text-slate-900">En cuánto tiempo puedes amortizar tu instalación</h3>
                <p>El tiempo de amortización de una instalación de placas solares suele situarse entre 5 y 10 años, según el consumo y el precio final. Cuanto más alto sea tu gasto actual en luz, antes recuperarás la inversión. Nuestra simulación te muestra una estimación del plazo de amortización para que puedas decidir con datos.</p>

                <h3 class="text-base font-semibold text-slate-900">Cuánto puedes ahorrar cada año en tu factura de luz</h3>
                <p>Con una instalación de placas solares bien dimensionada puedes reducir tu factura de luz entre un 50% y un 70%, e incluso llegar a factura 0. Ese ahorro anual es lo que hace que el precio de las placas solares sea rentable a medio plazo. Verlo en números te ayudará a entender el impacto real en tu bolsillo.</p>
              </div>
            </details>

            <details class="group rounded-2xl border border-slate-200 bg-white p-4">
              <summary class="cursor-pointer list-none text-sm font-semibold text-slate-900 marker:hidden">
                <div class="flex items-center justify-between gap-3">
                  <span>¿Por qué pedir tu precio de placas solares con nosotros?</span>
                  <span class="text-slate-500 group-open:rotate-180 transition-transform">⌄</span>
                </div>
              </summary>
              <div class="mt-3 space-y-3 text-sm text-slate-700">
                <p>Te ayudamos a calcular el precio de tus placas solares de forma clara, transparente y sin compromiso. Nuestro objetivo es que entiendas cada partida del presupuesto y sepas exactamente qué estás contratando. Te acompañamos desde el estudio inicial hasta la puesta en marcha de la instalación.</p>

                <ul class="list-inside list-disc space-y-1">
                  <li><strong>Estudio personalizado sin compromiso</strong></li>
                  <li><strong>Financiación hasta 20 años</strong></li>
                  <li><strong>Instalación en 24 horas</strong></li>
                  <li><strong>Garantías de 25 años</strong></li>
                </ul>
              </div>
            </details>

            <details class="group rounded-2xl border border-slate-200 bg-white p-4">
              <summary class="cursor-pointer list-none text-sm font-semibold text-slate-900 marker:hidden">
                <div class="flex items-center justify-between gap-3">
                  <span>Qué te pedimos en la calculadora (paso a paso)</span>
                  <span class="text-slate-500 group-open:rotate-180 transition-transform">⌄</span>
                </div>
              </summary>
              <div class="mt-3 space-y-3 text-sm text-slate-700">
                <p>Responde a estas preguntas y te mostraremos un presupuesto orientativo para tu instalación de placas solares.</p>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                  <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <div class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs text-slate-700">Vivienda</div>
                    <h3 class="mt-2 text-base font-semibold text-slate-900">¿Qué tipo de vivienda es?</h3>
                  </div>

                  <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <div class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs text-slate-700">Superficie</div>
                    <h3 class="mt-2 text-base font-semibold text-slate-900">¿Cuántos m² útiles tienes para instalar placas?</h3>
                    <p class="mt-2 text-sm text-slate-700">Cuenta solo la zona libre de sombras y obstáculos (chimeneas, claraboyas, antenas, etc.).</p>
                  </div>

                  <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <div class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs text-slate-700">Tejado</div>
                    <h3 class="mt-2 text-base font-semibold text-slate-900">Orientación del tejado</h3>
                    <p class="mt-2 text-sm text-slate-700">¿Hacia dónde está orientada la zona donde irían las placas?</p>
                    <p class="mt-2 text-sm text-slate-700">La orientación influye en la producción solar y el ahorro.</p>
                  </div>

                  <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <div class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs text-slate-700">Consumo</div>
                    <h3 class="mt-2 text-base font-semibold text-slate-900">Consumo de electricidad</h3>
                    <p class="mt-2 text-sm text-slate-700">¿Cómo prefieres indicar tu consumo?</p>
                    <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-slate-700">
                      <li>Importe medio de tu factura</li>
                      <li>kWh al año</li>
                    </ul>
                    <p class="mt-2 text-sm text-slate-700"><em>Si no lo tienes claro, una cifra aproximada nos sirve para calcular un presupuesto orientativo.</em></p>
                  </div>

                  <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <div class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs text-slate-700">Ubicación</div>
                    <h3 class="mt-2 text-base font-semibold text-slate-900">Provincia de la vivienda</h3>
                    <p class="mt-2 text-sm text-slate-700">¿En qué provincia está la vivienda?</p>
                    <p class="mt-2 text-sm text-slate-700"><em>Nos permite estimar la radiación solar media y ajustar mejor el cálculo.</em></p>
                  </div>

                  <div class="rounded-2xl border border-slate-200 bg-white p-4">
                    <div class="inline-flex rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs text-slate-700">Contacto</div>
                    <h3 class="mt-2 text-base font-semibold text-slate-900">Datos de contacto</h3>
                    <p class="mt-2 text-sm text-slate-700">Déjanos tus datos para mostrarte el presupuesto y enviártlo si lo deseas.</p>
                    <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-slate-700">
                      <li>Nombre (Ej.: Laura)</li>
                      <li>Teléfono (Ej.: 6XX XXX XXX)</li>
                      <li>Email (Ej.: nombre@correo.com)</li>
                    </ul>
                  </div>
                </div>
              </div>
            </details>

          </div>
        </div>
      </div>
    </section>
  </main>

  <div class="fixed bottom-4 left-1/2 z-50 -translate-x-1/2 rounded-2xl border border-white/10 bg-slate-900/90 px-4 py-3 text-sm text-slate-100 shadow-lg backdrop-blur"
       id="sc-toast" role="status" aria-live="polite"></div>

  <script>
  (function () {
    const totalSteps = 10;
    let currentStep = 1;

    const form = document.getElementById('solar-form');
    const panels = document.querySelectorAll('.sc5-panel');
    const stepText = document.getElementById('sc-steptext');
    const barFill = document.getElementById('sc-bar-fill');
    const toastEl = document.getElementById('sc-toast');

    const wizardCard = document.getElementById('wizard-card');

    const hiddenOri  = document.getElementById('orientacion');
    const hiddenModo = document.getElementById('consumo_modo');

    const fieldFacturaWrap = document.getElementById('sc-field-factura');
    const fieldKwhWrap = document.getElementById('sc-field-kwh');
    const consumoTitle = document.getElementById('sc-consumo-title');
    const consumoHelp = document.getElementById('sc-consumo-help');

    function fillUTMs(){
      const params = new URLSearchParams(window.location.search);
      ["utm_source","utm_medium","utm_campaign","utm_content","utm_term"].forEach(k => {
        const el = document.getElementById(k);
        if (el) el.value = params.get(k) || "";
      });
    }
    fillUTMs();

    function toast(msg){
      toastEl.textContent = msg;
      toastEl.classList.add('show');
      clearTimeout(toastEl._t);
      toastEl._t = setTimeout(() => toastEl.classList.remove('show'), 2200);
    }

    function setProgress(step){
      stepText.textContent = "Paso " + step + " de " + totalSteps;
      const pct = Math.round(((step - 1) / (totalSteps - 1)) * 100);
      barFill.style.width = pct + "%";
    }

    function scrollToWizard(){
      if (!wizardCard) return;
      const y = wizardCard.getBoundingClientRect().top + window.scrollY - 90;
      window.scrollTo({ top: y, behavior: 'smooth' });
    }

    function showStep(step){
      currentStep = step;
      panels.forEach(p => p.classList.toggle('active', parseInt(p.dataset.step, 10) === step));
      setProgress(step);

      if (step === 5) paintConsumoStep();
      if (step === 10) calcularResultado();

      const calc = document.getElementById('calculadora');
      if (calc && window.scrollY > (calc.offsetTop - 140)) scrollToWizard();
    }

    function paintSelection(groupEl, hiddenEl){
      const v = hiddenEl.value;
      groupEl.querySelectorAll('.sc5-opt').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.value === v);
      });
    }

    function paintAllSelections(){
      document.querySelectorAll('.sc5-options[data-pick]').forEach(group => {
        const name = group.getAttribute('data-pick');
        const hidden = document.getElementById(name);
        if (hidden) paintSelection(group, hidden);
      });
    }

    function paintConsumoStep(){
      const modo = (hiddenModo.value || "").trim();

      if (!modo){
        consumoTitle.textContent = "Indica tu consumo";
        consumoHelp.textContent = "Primero elige si lo indicarás por factura o por kWh.";
        fieldFacturaWrap.style.display = "none";
        fieldKwhWrap.style.display = "none";
        return;
      }

      if (modo === "factura"){
        consumoTitle.textContent = "¿Cuál es el importe medio de tu factura mensual?";
        consumoHelp.textContent = "Introduce un importe aproximado.";
        fieldFacturaWrap.style.display = "block";
        fieldKwhWrap.style.display = "none";
      } else {
        consumoTitle.textContent = "¿Cuál es tu consumo anual aproximado?";
        consumoHelp.textContent = "Introduce el consumo en kWh al año.";
        fieldFacturaWrap.style.display = "none";
        fieldKwhWrap.style.display = "block";
      }
    }

    function validateStep(step){
      if (step === 2) {
        const sup = document.getElementById('superficie_m2');
        if (sup.value) {
          const v = parseFloat(sup.value);
          if (isNaN(v) || v < 5) { toast('Indica una superficie válida (mínimo 5 m²).'); sup.focus(); return false; }
        }
      }

      if (step === 4) {
        if (!hiddenModo.value) { toast('Selecciona una opción.'); return false; }
      }

      if (step === 5) {
        const modo = hiddenModo.value;
        const factura = document.getElementById('factura_mensual');
        const kwh = document.getElementById('consumo_anual');

        if (modo === 'factura') {
          if (!factura.value) { toast('Indica el importe mensual de la factura.'); factura.focus(); return false; }
        } else if (modo === 'kwh') {
          if (!kwh.value) { toast('Indica el consumo anual en kWh.'); kwh.focus(); return false; }
        } else {
          toast('Selecciona primero si lo indicarás por factura o por kWh.');
          return false;
        }
      }

      if (step === 7 || step === 8 || step === 9) {
        const activePanel = document.querySelector('.sc5-panel[data-step="' + step + '"]');
        const requiredEls = activePanel.querySelectorAll('[required]');
        for (const el of requiredEls) {
          if (!el.checkValidity()) { el.reportValidity(); return false; }
        }
      }

      return true;
    }

    document.querySelectorAll('[data-next]').forEach(btn => {
      btn.addEventListener('click', () => {
        if (!validateStep(currentStep)) return;
        if (currentStep < totalSteps) showStep(currentStep + 1);
      });
    });

    document.querySelectorAll('[data-prev]').forEach(btn => {
      btn.addEventListener('click', () => {
        if (currentStep > 1) showStep(currentStep - 1);
      });
    });

    document.querySelectorAll('.sc5-options[data-pick]').forEach(group => {
      group.addEventListener('click', (e) => {
        const btn = e.target.closest('.sc5-opt');
        if (!btn) return;

        const pickName = group.getAttribute('data-pick');
        const hidden = document.getElementById(pickName);
        if (!hidden) return;

        hidden.value = btn.dataset.value;
        paintSelection(group, hidden);

        const panel = btn.closest('.sc5-panel');
        if (panel) {
          const step = parseInt(panel.dataset.step, 10);
          setTimeout(() => {
            if (step === currentStep && currentStep < totalSteps) showStep(currentStep + 1);
          }, 120);
        }
      });
    });

    document.getElementById('sc-reset').addEventListener('click', () => {
      document.getElementById('tipo_vivienda').value = 'unifamiliar';
      hiddenOri.value = 'sur';
      hiddenModo.value = '';

      ['superficie_m2','factura_mensual','consumo_anual','provincia','nombre','telefono','email'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
      });

      const consent = form.querySelector('input[name="consent_contacto"]');
      if (consent) consent.checked = false;

      paintAllSelections();
      showStep(1);

      const calc = document.getElementById('calculadora');
      if (calc) calc.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    function calcularResultado() {
      const superficie = parseFloat(document.getElementById('superficie_m2').value) || 0;
      const factura = parseFloat(document.getElementById('factura_mensual').value) || 0;
      const consumoInput = parseFloat(document.getElementById('consumo_anual').value) || 0;
      const orientacion = (document.getElementById('orientacion').value || 'sur');

      let consumo = consumoInput;

      const kwpPorM2 = 0.18;
      const potenciaPorSuperficie = superficie * kwpPorM2;

      if (!consumo && factura) consumo = (factura * 12) / 0.20;

      let potenciaPorConsumo = 0;
      if (consumo) potenciaPorConsumo = consumo / 1500;

      let potenciaRecomendada = 0;
      if (potenciaPorSuperficie && potenciaPorConsumo) potenciaRecomendada = Math.min(potenciaPorSuperficie, potenciaPorConsumo);
      else potenciaRecomendada = potenciaPorSuperficie || potenciaPorConsumo;

      let factorOrientacion = 1;
      if (orientacion === 'sureste' || orientacion === 'suroeste') factorOrientacion = 0.95;
      if (orientacion === 'este' || orientacion === 'oeste') factorOrientacion = 0.90;
      if (orientacion === 'norte') factorOrientacion = 0.80;

      potenciaRecomendada = potenciaRecomendada * factorOrientacion;

      if (!potenciaRecomendada || potenciaRecomendada < 1) potenciaRecomendada = 1;
      potenciaRecomendada = Math.min(potenciaRecomendada, 20);

      const potenciaPanel = 0.45;
      let numeroPaneles = Math.round(potenciaRecomendada / potenciaPanel);
      if (numeroPaneles < 2) numeroPaneles = 2;

      const precioPorKwp = 1200;
      const presupuesto = Math.round(potenciaRecomendada * precioPorKwp);

      const ahorroAnual = Math.round((factura || 60) * 12 * 0.6);

      document.getElementById('result-titulo').textContent = 'Instalación estimada: ' + potenciaRecomendada.toFixed(1) + ' kWp';
      document.getElementById('result-precio').textContent = 'Presupuesto orientativo: ' + presupuesto.toLocaleString('es-ES') + ' €';
      document.getElementById('result-placas').textContent = numeroPaneles + ' paneles aprox.';
      document.getElementById('result-ahorro').textContent = 'Ahorro estimado: ' + ahorroAnual.toLocaleString('es-ES') + ' €/año';

      document.getElementById('calc_kwp').value = potenciaRecomendada.toFixed(1);
      document.getElementById('calc_presupuesto').value = String(presupuesto);
      document.getElementById('calc_paneles').value = String(numeroPaneles);
      document.getElementById('calc_ahorro_anual').value = String(ahorroAnual);
    }

    paintAllSelections();
    showStep(1);
  })();
  </script>
</body>
</html>
