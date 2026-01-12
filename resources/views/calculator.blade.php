{{-- resources/views/calculadora.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Calculadora de placas solares | Precio orientativo en 1 minuto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Calcula el precio orientativo de tu instalación de placas solares en 1 minuto." />

  <script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="{{ asset('css/calculadora.css') }}">

<!-- Leaflet (1 sola vez) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Leaflet.draw -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css"/>
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

<!-- Turf (para m²) -->
<script src="https://unpkg.com/@turf/turf@6/turf.min.js"></script>




</head>

<body class="min-h-screen text-slate-900">
  <a class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:rounded-xl focus:bg-white focus:px-4 focus:py-2 focus:text-slate-900 focus:shadow-lg"
     href="#presentacion">Saltar al contenido</a>

  <!-- HERO / PRESENTACIÓN (SIN MANCHAS DE COLOR) -->
  <section id="presentacion" class="relative overflow-hidden" aria-labelledby="hero-title">
    <!-- Fondo neutro (sin orbes, sin blur, sin gradients verdes/amarillos) -->
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
          <a href="#calculadora"
             class="sc-btn-shine sc-focus inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-extrabold text-white shadow-lg shadow-slate-900/10 hover:bg-slate-800">
            Entrar en la calculadora
          </a>

          <a href="#seo"
             class="sc-btn-shine sc-focus inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-900 shadow-sm hover:bg-slate-50">
            Ver información y FAQ
          </a>

          <div class="w-full text-xs text-slate-600">
            *Cifra orientativa. El precio final se ajusta con un estudio técnico.
          </div>
        </div>

        <div class="mt-10 grid gap-3 sm:grid-cols-3" aria-label="Cómo funciona">
          <div class="sc-card sc-tilt sc-anim rounded-2xl border border-slate-200 p-4 shadow-sm">
            <div class="text-sm font-extrabold text-slate-900">1) Datos básicos</div>
            <div class="mt-1 text-sm text-slate-600">Vivienda y superficie útil</div>
          </div>

          <div class="sc-card sc-tilt sc-anim rounded-2xl border border-slate-200 p-4 shadow-sm">
            <div class="text-sm font-extrabold text-slate-900">2) Producción</div>
            <div class="mt-1 text-sm text-slate-600">Orientación + ubicación</div>
          </div>

          <div class="sc-card sc-tilt sc-anim rounded-2xl border border-slate-200 p-4 shadow-sm">
            <div class="text-sm font-extrabold text-slate-900">3) Resultado</div>
            <div class="mt-1 text-sm text-slate-600">kWp, paneles, € y ahorro</div>
          </div>
        </div>
      </div>

      <!-- ASIDE (SIN COLORES RAROS) -->
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

          <!-- Métricas -->
          <div class="mt-5 grid grid-cols-3 gap-3" aria-label="Métricas">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3">
              <div class="text-lg font-black text-slate-900">kWp</div>
              <div class="mt-1 text-xs font-medium text-slate-600">Potencia</div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3">
              <div class="text-lg font-black text-slate-900">€</div>
              <div class="mt-1 text-xs font-medium text-slate-600">Presupuesto</div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3">
              <div class="text-lg font-black text-slate-900">€/año</div>
              <div class="mt-1 text-xs font-medium text-slate-600">Ahorro</div>
            </div>
          </div>

          <!-- Bloques -->
          <div class="mt-6 grid gap-3 text-sm">
            <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white p-4">
              <div class="grid h-11 w-11 place-items-center rounded-2xl bg-amber-50 text-lg" aria-hidden="true">🏠</div>
              <div class="min-w-0">
                <div class="font-extrabold text-slate-900">Vivienda y tejado</div>
                <div class="text-sm text-slate-600">Tipo, orientación y superficie</div>
              </div>
            </div>

            <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white p-4">
              <div class="grid h-11 w-11 place-items-center rounded-2xl bg-sky-50 text-lg" aria-hidden="true">⚡</div>
              <div class="min-w-0">
                <div class="font-extrabold text-slate-900">Consumo</div>
                <div class="text-sm text-slate-600">Factura o kWh/año</div>
              </div>
            </div>

            <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white p-4">
              <div class="grid h-11 w-11 place-items-center rounded-2xl bg-emerald-50 text-lg" aria-hidden="true">📍</div>
              <div class="min-w-0">
                <div class="font-extrabold text-slate-900">Ubicación</div>
                <div class="text-sm text-slate-600">Ajuste por provincia</div>
              </div>
            </div>
          </div>

          <!-- CTA -->
          <div class="mt-6">
            <a href="#calculadora"
               class="sc-btn-shine sc-focus inline-flex w-full items-center justify-center rounded-2xl bg-yellow-400 px-6 py-3 text-sm font-extrabold text-slate-900 shadow-sm hover:bg-yellow-300">
              Empezar ahora
            </a>
            <div class="mt-3 text-xs text-slate-600 text-center">Tardarás menos de un minuto.</div>
          </div>
        </div>
      </aside>
    </div>

    <div class="mx-auto max-w-6xl px-4 pb-10">
      <div class="flex items-center justify-center gap-2 text-xs font-medium text-slate-500" aria-hidden="true">
        <span>Desliza para ver más</span>
        <span class="translate-y-[1px] sc-bounce">↓</span>
      </div>
    </div>
  </section>

  <!-- SEO (TU TEXTO) -->
  <section id="seo" class="py-14 text-slate-900" aria-label="Preguntas frecuentes y contenido informativo">
    <div class="mx-auto max-w-6xl px-4">
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
        <aside class="lg:col-span-4">
          <div class="sc-card sc-tilt sc-anim sticky top-24 rounded-3xl border border-slate-200 p-6 shadow-[0_18px_50px_-35px_rgba(15,23,42,.18)]">
            <div class="text-sm font-extrabold text-slate-900">Contenido</div>
            <p class="mt-1 text-sm text-slate-600">Navega por las secciones.</p>
            <nav class="mt-4 grid gap-2 text-sm" aria-label="Índice de contenidos">
              <a href="#sec-como" class="sc-focus rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 font-bold text-slate-900 hover:bg-white">Cómo calculamos</a>
              <a href="#sec-factores" class="sc-focus rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 font-bold text-slate-900 hover:bg-white">Factores</a>
              <a href="#sec-ejemplos" class="sc-focus rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 font-bold text-slate-900 hover:bg-white">Ejemplos</a>
              <a href="#sec-rentable" class="sc-focus rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 font-bold text-slate-900 hover:bg-white">Rentabilidad</a>
              <a href="#sec-porque" class="sc-focus rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 font-bold text-slate-900 hover:bg-white">Por qué nosotros</a>
            </nav>
            <a href="#calculadora" class="sc-btn-shine sc-focus mt-5 inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-extrabold text-white hover:bg-slate-800">
              Entrar en la calculadora
            </a>
          </div>
        </aside>

        <article class="lg:col-span-8">
          <div class="sc-anim rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_18px_50px_-35px_rgba(15,23,42,.18)]">
            <section id="sec-como" class="scroll-mt-24" aria-labelledby="h2-como">
              <h2 id="h2-como" class="text-2xl font-extrabold tracking-tight">¿Cómo calculamos el precio de tus placas solares?</h2>
              <p class="mt-3 text-sm leading-6 text-slate-700">El precio de tus placas solares lo calculamos a partir de tu consumo de luz, la orientación de tu tejado y tipo de residencia. Nuestra calculadora cruza estos datos con el coste actual de los equipos, la mano de obra... Así obtenemos un precio orientativo de instalación de placas solares ajustado a tu vivienda.</p>

              <h3 class="mt-6 text-lg font-extrabold">Qué datos te pedimos para hacer el presupuesto</h3>
              <p class="mt-2 text-sm leading-6 text-slate-700">Para calcular el precio de las placas solares te pedimos sólo los datos imprescindibles: tu consumo medio mensual, el tipo de vivienda, la orientación de tu tejado... Con esta información podemos estimar cuántos paneles necesitas, la potencia ideal de la instalación y un rango de precios realista para tu caso.</p>

              <h3 class="mt-6 text-lg font-extrabold">Qué incluye el precio orientativo de la instalación</h3>
              <p class="mt-2 text-sm leading-6 text-slate-700">El precio orientativo de la instalación de placas solares incluye los paneles, inversor, estructura, cableado, mano de obra de una instalación completa. De esta forma sabes desde el principio cuánto cuesta poner placas solares.</p>
            </section>

            <hr class="my-8 border-slate-200" />

            <section id="sec-factores" class="scroll-mt-24" aria-labelledby="h2-factores">
              <h2 id="h2-factores" class="text-2xl font-extrabold tracking-tight">Factores que influyen en el precio de las placas solares</h2>
              <p class="mt-3 text-sm leading-6 text-slate-700">El precio de las placas solares no es igual para todas las viviendas. Depende del consumo eléctrico, el espacio disponible en el tejado y si añades baterías u otros extras. Conocer estos factores te ayuda a entender por qué una instalación puede ser más barata o más cara y a decidir qué opción te conviene más.</p>

              <h3 class="mt-6 text-lg font-extrabold">¿Cómo afectan tu consumo de luz y la potencia que necesitas al precio de tus paneles solares?</h3>
              <p class="mt-2 text-sm leading-6 text-slate-700">Cuanto mayor es tu consumo de luz, mayor potencia debe tener la instalación y, por tanto, sube el precio de las placas solares. La clave está en dimensionar bien: una instalación demasiado pequeña se queda corta, y una sobredimensionada encarece la inversión sin necesidad. Por eso ajustamos la potencia a tu consumo real para equilibrar coste y ahorro.</p>

              <h3 class="mt-6 text-lg font-extrabold">¿Cómo afectan Tipo de tejado, orientación y sombras en el precio de tus paneles solares?</h3>
              <p class="mt-2 text-sm leading-6 text-slate-700">El tipo de tejado, su orientación y las sombras cercanas influyen directamente en el rendimiento de las placas solares y en el precio de la instalación. Un tejado sencillo, bien orientado y sin sombras abarata la estructura y la mano de obra. En cambio, tejados complejos, con muchas aguas o con obstáculos pueden requerir más material y tiempo de montaje.</p>

              <h3 class="mt-6 text-lg font-extrabold">Con o sin baterías, aerotermia y otros extras</h3>
              <p class="mt-2 text-sm leading-6 text-slate-700">Añadir baterías solares, aerotermia u otros extras aumenta el precio inicial de la instalación, pero también mejora mucho el confort y el ahorro a largo plazo. Las baterías te permiten aprovechar más la energía de tus placas solares durante cortes de la red eléctrica o durante la noche, y la aerotermia reduce el gasto en calefacción y agua caliente. Nuestra calculadora te muestra cómo cada combinación encaja mejor con tu vivienda y tu bolsillo.</p>
            </section>

            <hr class="my-8 border-slate-200" />

            <section id="sec-ejemplos" class="scroll-mt-24" aria-labelledby="h2-ejemplos">
              <h2 id="h2-ejemplos" class="text-2xl font-extrabold tracking-tight">Ejemplos de precio de instalaciones de placas solares</h2>
              <p class="mt-3 text-sm leading-6 text-slate-700">Para que te hagas una idea clara, te mostramos ejemplos reales de precio de instalaciones de placas solares según el tipo de vivienda. Así puedes comparar tu caso con otros parecidos y ver un rango de inversión habitual. Recuerda que se trata de precios orientativos, pero muy útiles para decidir si dar el paso al autoconsumo.</p>

              <h3 class="mt-6 text-lg font-extrabold">Precio de placas solares para una casa unifamiliar</h3>
              <p class="mt-2 text-sm leading-6 text-slate-700">En una casa unifamiliar, el precio de las placas solares suele ser más competitivo porque hay más superficie disponible y el tejado suele ser propio. Las instalaciones típicas son suficientes para cubrir buena parte del consumo de una familia. La inversión se amortiza en pocos años gracias al ahorro mensual en la factura.</p>

              <h3 class="mt-6 text-lg font-extrabold">Precio de placas solares para un piso o ático</h3>
              <p class="mt-2 text-sm leading-6 text-slate-700">En pisos o áticos, el precio de las placas solares depende de si se trata de una instalación individual en la azotea o de un proyecto compartido en la comunidad. El espacio suele ser más limitado, por lo que se buscan soluciones muy eficientes. Aun así, es posible reducir una parte importante de la factura con una instalación bien diseñada.</p>

              <h3 class="mt-6 text-lg font-extrabold">Precio de placas solares para negocio o local comercial</h3>
              <p class="mt-2 text-sm leading-6 text-slate-700">En negocios y locales comerciales, el precio de la instalación de placas solares está muy ligado a los horarios de consumo. Como muchas empresas consumen más durante el día, aprovechan mejor la producción solar y recuperan la inversión antes. Una buena instalación fotovoltaica puede recortar de forma notable los costes fijos de electricidad.</p>
            </section>

            <hr class="my-8 border-slate-200" />

            <section id="sec-rentable" class="scroll-mt-24" aria-labelledby="h2-rentable">
              <h2 id="h2-rentable" class="text-2xl font-extrabold tracking-tight">¿Es rentable el precio de las placas solares en tu caso?</h2>
              <p class="mt-3 text-sm leading-6 text-slate-700">La verdadera pregunta no es sólo cuánto cuestan las placas solares, sino si son rentables para ti. Analizamos tu consumo, tu tarifa eléctrica y creamos el precio estimado de la instalación para calcular el tiempo de amortización. Así sabrás en cuántos años recuperarás la inversión y cuánto podrías ahorrar a partir de entonces.</p>

              <h3 class="mt-6 text-lg font-extrabold">En cuánto tiempo puedes amortizar tu instalación</h3>
              <p class="mt-2 text-sm leading-6 text-slate-700">El tiempo de amortización de una instalación de placas solares suele situarse entre 5 y 10 años, según el consumo y el precio final. Cuanto más alto sea tu gasto actual en luz, antes recuperarás la inversión. Nuestra simulación te muestra una estimación del plazo de amortización para que puedas decidir con datos.</p>

              <h3 class="mt-6 text-lg font-extrabold">Cuánto puedes ahorrar cada año en tu factura de luz</h3>
              <p class="mt-2 text-sm leading-6 text-slate-700">Con una instalación de placas solares bien dimensionada puedes reducir tu factura de luz entre un 50% y un 70%, e incluso llegar a factura 0. Ese ahorro anual es lo que hace que el precio de las placas solares sea rentable a medio plazo. Verlo en números te ayudará a entender el impacto real en tu bolsillo.</p>
            </section>

            <hr class="my-8 border-slate-200" />

            <section id="sec-porque" class="scroll-mt-24" aria-labelledby="h2-porque">
              <h2 id="h2-porque" class="text-2xl font-extrabold tracking-tight">¿Por qué pedir tu precio de placas solares con nosotros?</h2>
              <p class="mt-3 text-sm leading-6 text-slate-700">Te ayudamos a calcular el precio de tus placas solares de forma clara, transparente y sin compromiso. Nuestro objetivo es que entiendas cada partida del presupuesto y sepas exactamente qué estás contratando. Te acompañamos desde el estudio inicial hasta la puesta en marcha de la instalación.</p>

              <div class="mt-6 grid gap-3 sm:grid-cols-2">
                <div class="sc-tilt rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold">✅ Estudio personalizado sin compromiso</div>
                <div class="sc-tilt rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold">💳 Financiación hasta 20 años</div>
                <div class="sc-tilt rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold">⚡ Instalación en 24 horas</div>
                <div class="sc-tilt rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-bold">🛡️ Garantías de 25 años</div>
              </div>

              <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="#calculadora" class="sc-btn-shine sc-focus inline-flex items-center justify-center rounded-2xl bg-yellow-400 px-6 py-3 text-sm font-extrabold text-slate-900 hover:bg-yellow-300">
                  Entrar en la calculadora
                </a>
                <span class="text-xs text-slate-600">Tardarás menos de 1 minuto.</span>
              </div>
            </section>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section id="calculadora" class="py-0">
  <!-- PASO 1 · MAPA -->
  <div id="sc-step-map" class="relative min-h-screen w-full">

    <!-- PANEL SUPERIOR -->
    <div class="pointer-events-none absolute left-0 right-0 top-0 z-20">
      <div class="pointer-events-auto mx-auto max-w-6xl px-4 pt-4">
        <div class="sc-card rounded-3xl border border-slate-200 bg-white p-5 shadow-lg">

          <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
              <div class="text-sm font-extrabold text-slate-900">
                Paso 1 · Ubicación y superficie
              </div>
              <p class="mt-1 text-sm text-slate-600">
                Busca tu vivienda y dibuja el área donde deseas instalar los paneles solares.
              </p>
            </div>

            <div class="flex gap-2">
              <button id="btnLocate"
                class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-bold text-white hover:bg-slate-800">
                📍 Mi ubicación
              </button>

              <button id="btnClear"
                class="rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-900 hover:bg-slate-50">
                Borrar
              </button>

              <button id="btnNext"
                disabled
                class="rounded-2xl bg-yellow-400 px-4 py-2 text-sm font-extrabold text-slate-900 disabled:opacity-50">
                Continuar →
              </button>
            </div>
          </div>

          <!-- BUSCADOR -->
         <div class="mt-4 addr-wrap">
          <input id="addr" type="text" autocomplete="off"
            placeholder="Ej: Calle Mayor 10, Madrid"
            class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm">

          <div id="suggest"
            class="hidden mt-2 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-lg">
          </div>
        </div>
        </div>


          <!-- SUPERFICIE -->
          <div class="mt-4 flex flex-wrap items-center gap-3 text-sm">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
              <span class="font-bold">Superficie:</span>
              <span id="areaLabel" class="font-black">0</span> m²
            </div>

            <span class="text-xs text-slate-600">
              Usa el icono de polígono del mapa y marca punto a punto el tejado
            </span>
          </div>

          <!-- INPUTS OCULTOS -->
          <input type="hidden" id="sc_lat">
          <input type="hidden" id="sc_lng">
          <input type="hidden" id="sc_area_m2">
          <input type="hidden" id="sc_geojson">

        </div>
      </div>
    </div>

    <!-- MAPA -->
    <div id="scMap" class="absolute inset-0 z-10"></div>

    <!-- AVISOS -->
    <div class="pointer-events-none absolute bottom-0 left-0 right-0 z-20">
      <div class="pointer-events-auto mx-auto max-w-6xl px-4 pb-4">
        <div id="mapHint"
          class="hidden rounded-3xl border border-slate-200 bg-white p-4 text-sm shadow-lg">
        </div>
      </div>
    </div>

  </div>
</section>

<script>
(() => {
  const $ = (id) => document.getElementById(id);

  const hintBox = $('mapHint');
  const hint = (msg) => {
    if (!hintBox) return;
    hintBox.textContent = msg;
    hintBox.classList.remove('hidden');
    clearTimeout(window.__hintT);
    window.__hintT = setTimeout(() => hintBox.classList.add('hidden'), 4500);
  };

  // Guards
  if (!window.L) return console.error("Leaflet no cargó");
  if (!window.turf) return console.error("Turf no cargó (falta incluirlo en head)");
  if (!$('scMap')) return console.error("#scMap no existe");

  /* =========================
     MAPA (SATÉLITE + LABELS + FALLBACK)
  ========================= */
  const map = L.map('scMap', {
    zoomControl: false
  }).setView([40.4168, -3.7038], 18);
  window.scMap = map;

  L.control.zoom({ position: 'bottomright' }).addTo(map);

  const esriImagery = L.tileLayer(
    "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
    { maxZoom: 20, attribution: "Esri" }
  );

  const labels = L.tileLayer(
    "https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png",
    { subdomains: "abcd", maxZoom: 20, attribution: "CARTO" }
  );

  const osmFallback = L.tileLayer(
    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
    { maxZoom: 20, attribution: "© OpenStreetMap" }
  );

  esriImagery.addTo(map);
  labels.addTo(map);

  let esriErrors = 0;
  let switched = false;
  const switchToOSM = () => {
    if (switched) return;
    switched = true;
    try { map.removeLayer(esriImagery); } catch {}
    osmFallback.addTo(map);
    hint("Satélite no disponible: usando mapa alternativo.");
  };

  esriImagery.on("tileerror", () => {
    esriErrors += 1;
    if (esriErrors >= 6) switchToOSM();
  });

  setTimeout(() => map.invalidateSize(true), 200);
  window.addEventListener("resize", () => map.invalidateSize(true));

  /* =========================
     DIBUJO (Leaflet.draw) + m²
  ========================= */
  const drawnItems = new L.FeatureGroup();
  map.addLayer(drawnItems);

  const drawControl = new L.Control.Draw({
    position: "bottomleft",
    draw: {
      polygon: { allowIntersection: false },
      polyline: false,
      rectangle: false,
      circle: false,
      marker: false,
      circlemarker: false
    },
    edit: { featureGroup: drawnItems, remove: true }
  });
  map.addControl(drawControl);

  let polygon = null;

  const updateArea = () => {
    const label = $('areaLabel');
    const input = $('sc_area_m2');
    const geo = $('sc_geojson');
    const btnNext = $('btnNext');

    if (!polygon) {
      label.textContent = '0';
      input.value = '';
      geo.value = '';
      btnNext.disabled = true;
      return;
    }

    const gj = polygon.toGeoJSON();
    const area = Math.round(turf.area(gj));

    label.textContent = area.toLocaleString('es-ES');
    input.value = area;
    geo.value = JSON.stringify(gj);

    // centro aproximado
    const c = polygon.getBounds().getCenter();
    $('sc_lat').value = c.lat;
    $('sc_lng').value = c.lng;

    btnNext.disabled = area <= 0;
  };

  map.on(L.Draw.Event.CREATED, (e) => {
    drawnItems.clearLayers();
    polygon = e.layer;
    drawnItems.addLayer(polygon);
    updateArea();
    hint("Tejado dibujado ✔️");
  });

  map.on(L.Draw.Event.EDITED, updateArea);
  map.on(L.Draw.Event.DELETED, () => {
    polygon = null;
    updateArea();
  });

  /* =========================
     BOTONES
  ========================= */
  $('btnClear').addEventListener('click', () => {
    drawnItems.clearLayers();
    polygon = null;
    updateArea();
    hint("Dibujo borrado.");
  });

  let userMarker = null;
  $('btnLocate').addEventListener('click', () => {
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
        hint("Ubicación encontrada. Dibuja el tejado.");
      },
      () => hint("No se pudo obtener la ubicación (requiere HTTPS o localhost)")
    );
  });

  $('btnNext').addEventListener('click', () => {
    hint("Paso 1 completado ✔️ (siguiente: tipo de instalación)");
    // aquí enlazas tu paso 2
  });

  /* =========================
     BUSCADOR (Nominatim + sugerencias)
  ========================= */
  const addr = $('addr');
  const suggest = $('suggest');

  

  const hideSuggest = () => {
    suggest.classList.add('hidden');
    suggest.innerHTML = '';
  };

  const showSuggest = (items) => {
    if (!items.length) return hideSuggest();
    suggest.innerHTML = items.map((r, i) => `
      <button type="button" data-i="${i}" class="w-full px-4 py-3 text-left text-sm hover:bg-slate-50">
        <div class="font-bold text-slate-900">${(r.display_name || '').split(',')[0]}</div>
        <div class="text-xs text-slate-600">${r.display_name || ''}</div>
      </button>
    `).join('');
    suggest.classList.remove('hidden');
  };

  let deb = null;
  let last = [];

  const search = async (q) => {
    const url = `https://nominatim.openstreetmap.org/search?format=json&limit=6&q=${encodeURIComponent(q)}`;
    const res = await fetch(url, { headers: { "Accept": "application/json" } });
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    return await res.json();
  };

  addr.addEventListener('input', () => {
    clearTimeout(deb);
    const q = addr.value.trim();
    if (q.length < 3) return hideSuggest();

    deb = setTimeout(async () => {
      try {
        last = await search(q);
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
      const data = await search(q);
      if (!data.length) return hint("No se encontró la dirección");
      const r = data[0];
      map.setView([Number(r.lat), Number(r.lon)], 20);
      hideSuggest();
      hint("Dirección encontrada. Dibuja el área.");
    } catch (e) {
      console.error(e);
      hint("Error buscando dirección");
    }
  });

  suggest.addEventListener('click', (e) => {
    const btn = e.target.closest('button[data-i]');
    if (!btn) return;
    const r = last[Number(btn.dataset.i)];
    if (!r) return;

    map.setView([Number(r.lat), Number(r.lon)], 20);
    hideSuggest();
    hint("Dirección seleccionada. Dibuja el área.");
  });

  document.addEventListener('click', (e) => {
    if (e.target === addr || suggest.contains(e.target)) return;
    hideSuggest();
  });

  hint("Escribe tu dirección y dibuja el tejado con el polígono.");
})();
</script>

</body>
</html>