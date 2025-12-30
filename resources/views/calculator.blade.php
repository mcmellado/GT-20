<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calculadora de placas solares | Precio orientativo en 1 minuto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Calcula el precio orientativo de tu instalación de placas solares en 1 minuto. Estimación según consumo, tejado, orientación, superficie y provincia.">

<link rel="stylesheet" href="{{ asset('css/calculadora.css') }}?v={{ time() }}">


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

<body>
  <a class="sc5-sr" href="#calculadora">Saltar a la calculadora</a>
  <header class="sc5-top">
    <div class="sc5-shell sc5-topbar">
      <div class="sc5-brand">
        <div class="sc5-logo" aria-hidden="true">☀️</div>
        <div>
          <div class="sc5-brand-name">Calculadora Solar</div>
          <div class="sc5-brand-sub">Estimación orientativa en 1 minuto</div>
        </div>
      </div>

      <div class="sc5-badges" aria-label="Beneficios rápidos">
        <span class="sc5-badge">🔒 Sin compromiso</span>
        <span class="sc5-badge">📍 Ajuste por provincia</span>
        <span class="sc5-badge">⚡ Resultado al instante</span>
      </div>
    </div>
  </header>

  <main class="sc5-page">
   <section class="sc5-hero" aria-labelledby="hero-title">
      <div class="sc5-shell sc5-hero-grid">
        <div class="sc5-hero-copy">
          <div class="sc5-kicker">Autoconsumo · Placas solares · Presupuesto orientativo</div>

          <h1 id="hero-title" class="sc5-h1">
            Calcula el precio de tus placas solares en <span class="sc5-grad">1 minuto</span>
          </h1>

          <p class="sc5-lead">
            Responde a unas preguntas y obtén una estimación orientativa de
            <strong>potencia</strong>, <strong>presupuesto</strong> y <strong>ahorro anual</strong>.
          </p>

          <div class="sc5-pills" aria-label="Puntos clave">
            <span class="sc5-pill">⏱️ 1 minuto</span>
            <span class="sc5-pill">✅ Datos mínimos</span>
            <span class="sc5-pill">📩 Recibe el resumen</span>
            <span class="sc5-pill">🧾 Sin compromiso</span>
          </div>

          <div class="sc5-hero-actions">
            <a class="sc5-btn primary" href="#calculadora">Empezar cálculo</a>
            <a class="sc5-btn ghost" href="#seo">Ver información y FAQ</a>
          </div>

          <div class="sc5-micro">
            *Cifra orientativa. El precio final se ajusta con un estudio técnico.
          </div>
        </div>

        <aside class="sc5-hero-card" aria-label="Resumen de lo que obtendrás">
          <div class="sc5-card-title">Lo que obtendrás</div>

          <div class="sc5-stats">
            <div class="sc5-stat">
              <div class="sc5-stat-big">kWp</div>
              <div class="sc5-stat-sub">Potencia recomendada</div>
            </div>
            <div class="sc5-stat">
              <div class="sc5-stat-big">€</div>
              <div class="sc5-stat-sub">Presupuesto orientativo</div>
            </div>
            <div class="sc5-stat">
              <div class="sc5-stat-big">€/año</div>
              <div class="sc5-stat-sub">Ahorro estimado</div>
            </div>
          </div>

          <div class="sc5-list">
            <div class="sc5-li"><span class="sc5-dot"></span>Tipo de vivienda y superficie útil</div>
            <div class="sc5-li"><span class="sc5-dot"></span>Orientación del tejado</div>
            <div class="sc5-li"><span class="sc5-dot"></span>Consumo (factura o kWh/año)</div>
            <div class="sc5-li"><span class="sc5-dot"></span>Provincia (ajuste por radiación)</div>
          </div>

          <div class="sc5-card-foot">
            <span class="sc5-badge soft">⭐ Estimación rápida</span>
            <span class="sc5-badge soft">📈 Más datos = más precisión</span>
          </div>
        </aside>
      </div>

      <div class="sc5-scroll" aria-hidden="true">
        <span>Desliza para empezar</span>
        <span class="sc5-arrow">↓</span>
      </div>
    </section>

    {{-- CALCULADORA --}}
    <section id="calculadora" class="sc5-section" aria-label="Calculadora">
      <div class="sc5-shell">
        <div class="sc5-section-head">
          <h2 class="sc5-h2">Calculadora de placas solares</h2>
          <p class="sc5-sub">Responde a las preguntas y obtén el resultado al instante.</p>
        </div>

        @if ($errors->any())
          <section class="sc5-alert" aria-label="Errores de formulario">
            <div class="sc5-alert-title">Revisa estos campos</div>
            <ul class="sc5-alert-list">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </section>
        @endif

        <div class="sc5-grid">
          <div class="sc5-wizard" id="wizard-card">
            <div class="sc5-wizard-head">
              <div>
                <div class="sc5-wizard-title">Tu cálculo</div>
                <div class="sc5-wizard-sub">Paso a paso · resultado orientativo</div>
              </div>

              <button type="button" class="sc5-reset" id="sc-reset" aria-label="Reiniciar formulario">Reiniciar</button>
            </div>

            <form id="solar-form" method="POST" action="{{ route('calculator.store') }}" class="sc5-form">
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

              <div class="sc5-progress" aria-label="Progreso">
                <div class="sc5-progress-top">
                  <div class="sc5-steptext" id="sc-steptext">Paso 1 de 10</div>
                  <div class="sc5-hint">Tip: puedes clicar una opción para avanzar</div>
                </div>
                <div class="sc5-bar" aria-hidden="true">
                  <div class="sc5-bar-fill" id="sc-bar-fill" style="width:0%"></div>
                </div>
              </div>

              <div class="sc5-panels">

                {{-- STEP 1 --}}
                <section class="sc5-panel active" data-step="1">
                  <h3 class="sc5-q">¿Qué tipo de vivienda es?</h3>
                  <p class="sc5-help">Selecciona una opción.</p>

                 <div class="sc5-options sc5-options-4" data-pick="tipo_vivienda">
                  <button type="button" class="sc5-opt" data-value="casa">
                    <span class="sc5-opt-top">🏡 Casa</span>
                    <span class="sc5-opt-sub">Unifamiliar / chalet</span>
                  </button>

                  <button type="button" class="sc5-opt" data-value="adosado">
                    <span class="sc5-opt-top">🏘️ Adosado</span>
                    <span class="sc5-opt-sub">Adosado / pareado</span>
                  </button>

                  <button type="button" class="sc5-opt" data-value="piso">
                    <span class="sc5-opt-top">🏢 Piso / Ático</span>
                    <span class="sc5-opt-sub">En edificio o comunidad</span>
                  </button>

                  <button type="button" class="sc5-opt" data-value="negocio">
                    <span class="sc5-opt-top">🏭 Negocio</span>
                    <span class="sc5-opt-sub">Local / nave / empresa</span>
                  </button>
                </div>


                  <div class="sc5-nav">
                    <button type="button" class="sc5-btn ghost" disabled>Atrás</button>
                    <button type="button" class="sc5-btn primary" data-next>Siguiente</button>
                  </div>
                </section>

                {{-- STEP 2 --}}
                <section class="sc5-panel" data-step="2">
                  <h3 class="sc5-q">¿Cuánta superficie útil de tejado tienes?</h3>
                  <p class="sc5-help">Aproximado. Si no lo sabes, pon una estimación.</p>

                  <label class="sc5-field">
                    <span class="sc5-label">Superficie útil (m²)</span>
                    <input type="number" id="superficie_m2" name="superficie_m2" min="5" max="500" step="1"
                      placeholder="Ej: 60" value="{{ old('superficie_m2') }}">
                  </label>

                  <div class="sc5-nav">
                    <button type="button" class="sc5-btn ghost" data-prev>Atrás</button>
                    <button type="button" class="sc5-btn primary" data-next>Siguiente</button>
                  </div>
                </section>

                {{-- STEP 3 --}}
                <section class="sc5-panel" data-step="3">
                  <h3 class="sc5-q">¿Cuál es la orientación principal del tejado?</h3>
                  <p class="sc5-help">Selecciona una opción.</p>

                  <div class="sc5-options" data-pick="orientacion">
                    <button type="button" class="sc5-opt" data-value="sur">Sur</button>
                    <button type="button" class="sc5-opt" data-value="sureste">Sureste</button>
                    <button type="button" class="sc5-opt" data-value="suroeste">Suroeste</button>
                    <button type="button" class="sc5-opt" data-value="este">Este</button>
                    <button type="button" class="sc5-opt" data-value="oeste">Oeste</button>
                    <button type="button" class="sc5-opt" data-value="norte">Norte</button>
                  </div>

                  <div class="sc5-nav">
                    <button type="button" class="sc5-btn ghost" data-prev>Atrás</button>
                    <button type="button" class="sc5-btn primary" data-next>Siguiente</button>
                  </div>
                </section>

                {{-- STEP 4 --}}
                <section class="sc5-panel" data-step="4">
                  <h3 class="sc5-q">¿Cómo prefieres indicar tu consumo?</h3>
                  <p class="sc5-help">Elige una opción.</p>

                  <div class="sc5-options onecol" data-pick="consumo_modo">
                    <button type="button" class="sc5-opt" data-value="factura">Por importe de factura</button>
                    <button type="button" class="sc5-opt" data-value="kwh">Por kWh al año</button>
                  </div>

                  <div class="sc5-nav">
                    <button type="button" class="sc5-btn ghost" data-prev>Atrás</button>
                    <button type="button" class="sc5-btn primary" data-next>Siguiente</button>
                  </div>
                </section>

                {{-- STEP 5 --}}
                <section class="sc5-panel" data-step="5">
                  <h3 class="sc5-q" id="sc-consumo-title">Indica tu consumo</h3>
                  <p class="sc5-help" id="sc-consumo-help">Rellena el dato.</p>

                  <label class="sc5-field" id="sc-field-factura">
                    <span class="sc5-label">Factura mensual (€)</span>
                    <input type="number" id="factura_mensual" name="factura_mensual" min="0" step="1"
                      placeholder="Ej: 85" value="{{ old('factura_mensual') }}">
                  </label>

                  <label class="sc5-field" id="sc-field-kwh">
                    <span class="sc5-label">Consumo anual (kWh)</span>
                    <input type="number" id="consumo_anual" name="consumo_anual" min="0" step="100"
                      placeholder="Ej: 4200" value="{{ old('consumo_anual') }}">
                  </label>

                  <p class="sc5-tip"><em>Con una cifra aproximada ya podemos estimar un presupuesto orientativo.</em></p>

                  <div class="sc5-nav">
                    <button type="button" class="sc5-btn ghost" data-prev>Atrás</button>
                    <button type="button" class="sc5-btn primary" data-next>Siguiente</button>
                  </div>
                </section>

                {{-- STEP 6 --}}
                <section class="sc5-panel" data-step="6">
                  <h3 class="sc5-q">Provincia de la vivienda</h3>
                  <p class="sc5-help">Nos permite ajustar la producción media.</p>

                  <label class="sc5-field">
                    <span class="sc5-label">Provincia</span>
                    <input type="text" id="provincia" name="provincia" placeholder="Ej: Madrid" value="{{ old('provincia') }}">
                  </label>

                  <div class="sc5-nav">
                    <button type="button" class="sc5-btn ghost" data-prev>Atrás</button>
                    <button type="button" class="sc5-btn primary" data-next>Siguiente</button>
                  </div>
                </section>

                {{-- STEP 7 --}}
                <section class="sc5-panel" data-step="7">
                  <h3 class="sc5-q">Datos de contacto</h3>
                  <p class="sc5-help">Déjanos tu nombre para identificar tu solicitud.</p>

                  <label class="sc5-field">
                    <span class="sc5-label">Nombre</span>
                    <input type="text" id="nombre" name="nombre" required autocomplete="name"
                      placeholder="Ej: Laura" value="{{ old('nombre') }}">
                  </label>

                  <div class="sc5-nav">
                    <button type="button" class="sc5-btn ghost" data-prev>Atrás</button>
                    <button type="button" class="sc5-btn primary" data-next>Siguiente</button>
                  </div>
                </section>

                {{-- STEP 8 --}}
                <section class="sc5-panel" data-step="8">
                  <h3 class="sc5-q">Teléfono</h3>
                  <p class="sc5-help">Para contactarte si quieres afinar el estudio.</p>

                  <label class="sc5-field">
                    <span class="sc5-label">Teléfono</span>
                    <input type="tel" id="telefono" name="telefono" required inputmode="tel" autocomplete="tel"
                      placeholder="Ej: 6XX XXX XXX" value="{{ old('telefono') }}">
                  </label>

                  <div class="sc5-nav">
                    <button type="button" class="sc5-btn ghost" data-prev>Atrás</button>
                    <button type="button" class="sc5-btn primary" data-next>Siguiente</button>
                  </div>
                </section>

                {{-- STEP 9 --}}
                <section class="sc5-panel" data-step="9">
                  <h3 class="sc5-q">Email</h3>
                  <p class="sc5-help">Te enviaremos el resumen si lo necesitas.</p>

                  <label class="sc5-field">
                    <span class="sc5-label">Email</span>
                    <input type="email" id="email" name="email" required autocomplete="email"
                      placeholder="Ej: nombre@correo.com" value="{{ old('email') }}">
                  </label>

                  <label class="sc5-check">
                    <input type="checkbox" name="consent_contacto" required>
                    <span>Acepto que me contactéis para recibir información sobre la instalación fotovoltaica.</span>
                  </label>

                  <p class="sc5-legal">Tus datos se usarán solo para atender tu solicitud, según la política de privacidad.</p>

                  <div class="sc5-nav">
                    <button type="button" class="sc5-btn ghost" data-prev>Atrás</button>
                    <button type="button" class="sc5-btn primary" data-next>Ver resultado</button>
                  </div>
                </section>

                {{-- STEP 10 --}}
                <section class="sc5-panel" data-step="10">
                  <h3 class="sc5-q">Tu resultado orientativo</h3>
                  <p class="sc5-help">Estimación basada en los datos introducidos.</p>

                  <div class="sc5-result">
                    <div class="sc5-result-main" id="result-titulo">Instalación estimada: — kWp</div>
                    <div class="sc5-result-sub" id="result-precio">Presupuesto orientativo: — €</div>

                    <div class="sc5-result-tags">
                      <span class="sc5-tag" id="result-placas">— paneles</span>
                      <span class="sc5-tag" id="result-ahorro">Ahorro estimado: — €/año</span>
                    </div>

                    <div class="sc5-note2">Cifra orientativa. El precio final se ajusta con un estudio técnico.</div>
                  </div>

                  <div class="sc5-nav">
                    <button type="button" class="sc5-btn ghost" data-prev>Atrás</button>
                    <button type="submit" class="sc5-btn primary">Enviar solicitud</button>
                  </div>
                </section>

              </div>
            </form>
          </div>

          <aside class="sc5-side" aria-label="Ayuda rápida">
            <div class="sc5-side-card">
              <div class="sc5-side-title">Consejos rápidos</div>
              <div class="sc5-side-sub">Para que el resultado sea más preciso</div>

              <div class="sc5-side-items">
                <div class="sc5-side-item">
                  <div class="sc5-side-ic" aria-hidden="true">📐</div>
                  <div>
                    <div class="sc5-side-item-title">Superficie útil</div>
                    <div class="sc5-side-item-text">Cuenta solo la zona libre de sombras y obstáculos.</div>
                  </div>
                </div>

                <div class="sc5-side-item">
                  <div class="sc5-side-ic" aria-hidden="true">🧭</div>
                  <div>
                    <div class="sc5-side-item-title">Orientación</div>
                    <div class="sc5-side-item-text">Sur suele rendir más que Este/Oeste.</div>
                  </div>
                </div>

                <div class="sc5-side-item">
                  <div class="sc5-side-ic" aria-hidden="true">⚡</div>
                  <div>
                    <div class="sc5-side-item-title">Consumo</div>
                    <div class="sc5-side-item-text">Con una aproximación ya sirve para estimar.</div>
                  </div>
                </div>

                <div class="sc5-side-item">
                  <div class="sc5-side-ic" aria-hidden="true">📍</div>
                  <div>
                    <div class="sc5-side-item-title">Provincia</div>
                    <div class="sc5-side-item-text">Ajusta la producción media de tu zona.</div>
                  </div>
                </div>
              </div>

              <div class="sc5-side-foot">*Resultado orientativo.</div>
            </div>
          </aside>
        </div>
      </div>
    </section>

    {{-- SEO --}}
   <section id="seo" class="sc5-section" aria-label="Preguntas frecuentes y contenido informativo">
  <div class="sc5-shell">
    <div class="sc5-seo">
      <div class="sc5-seo-head">
        <h2 class="sc5-seo-title">Preguntas frecuentes sobre el precio de placas solares</h2>
        <p class="sc5-seo-sub">
          Haz clic en cada apartado para ver la información. Todo el contenido está disponible y organizado para que sea más fácil de leer.
        </p>
      </div>

      <div class="sc5-faq" role="list">

        <details class="sc5-faq-item">
          <summary class="sc5-faq-q">¿Cómo calculamos el precio de tus placas solares?</summary>
          <div class="sc5-faq-a">
            <p>El precio de tus placas solares lo calculamos a partir de tu consumo de luz, la orientación de tu tejado y tipo de residencia. Nuestra calculadora cruza estos datos con el coste actual de los equipos, la mano de obra... Así obtenemos un precio orientativo de instalación de placas solares ajustado a tu vivienda.</p>

            <h3>Qué datos te pedimos para hacer el presupuesto</h3>
            <p>Para calcular el precio de las placas solares te pedimos sólo los datos imprescindibles: tu consumo medio mensual, el tipo de vivienda, la orientación de tu tejado... Con esta información podemos estimar cuántos paneles necesitas, la potencia ideal de la instalación y un rango de precios realista para tu caso.</p>

            <h3>Qué incluye el precio orientativo de la instalación</h3>
            <p>El precio orientativo de la instalación de placas solares incluye los paneles, inversor, estructura, cableado, mano de obra de una instalación completa. De esta forma sabes desde el principio cuánto cuesta poner placas solares.</p>
          </div>
        </details>

        <details class="sc5-faq-item">
          <summary class="sc5-faq-q">Factores que influyen en el precio de las placas solares</summary>
          <div class="sc5-faq-a">
            <p>El precio de las placas solares no es igual para todas las viviendas. Depende del consumo eléctrico, el espacio disponible en el tejado y si añades baterías u otros extras. Conocer estos factores te ayuda a entender por qué una instalación puede ser más barata o más cara y a decidir qué opción te conviene más.</p>

            <h3>¿Cómo afectan tu consumo de luz y la potencia que necesitas al precio?</h3>
            <p>Cuanto mayor es tu consumo de luz, mayor potencia debe tener la instalación y, por tanto, sube el precio de las placas solares. La clave está en dimensionar bien: una instalación demasiado pequeña se queda corta, y una sobredimensionada encarece la inversión sin necesidad. Por eso ajustamos la potencia a tu consumo real para equilibrar coste y ahorro.</p>

            <h3>¿Cómo afectan el tipo de tejado, orientación y sombras?</h3>
            <p>El tipo de tejado, su orientación y las sombras cercanas influyen directamente en el rendimiento de las placas solares y en el precio de la instalación. Un tejado sencillo, bien orientado y sin sombras abarata la estructura y la mano de obra. En cambio, tejados complejos, con muchas aguas o con obstáculos pueden requerir más material y tiempo de montaje.</p>

            <h3>Con o sin baterías, aerotermia y otros extras</h3>
            <p>Añadir baterías solares, aerotermia u otros extras aumenta el precio inicial de la instalación, pero también mejora mucho el confort y el ahorro a largo plazo. Las baterías te permiten aprovechar más la energía de tus placas solares durante cortes de la red eléctrica o durante la noche, y la aerotermia reduce el gasto en calefacción y agua caliente. Nuestra calculadora te muestra cómo cada combinación encaja mejor con tu vivienda y tu bolsillo.</p>
          </div>
        </details>

        <details class="sc5-faq-item">
          <summary class="sc5-faq-q">Ejemplos de precio de instalaciones de placas solares</summary>
          <div class="sc5-faq-a">
            <p>Para que te hagas una idea clara, te mostramos ejemplos reales de precio de instalaciones de placas solares según el tipo de vivienda. Así puedes comparar tu caso con otros parecidos y ver un rango de inversión habitual. Recuerda que se trata de precios orientativos, pero muy útiles para decidir si dar el paso al autoconsumo.</p>

            <h3>Precio de placas solares para una casa unifamiliar</h3>
            <p>En una casa unifamiliar, el precio de las placas solares suele ser más competitivo porque hay más superficie disponible y el tejado suele ser propio. Las instalaciones típicas son suficientes para cubrir buena parte del consumo de una familia. La inversión se amortiza en pocos años gracias al ahorro mensual en la factura.</p>

            <h3>Precio de placas solares para un piso o ático</h3>
            <p>En pisos o áticos, el precio de las placas solares depende de si se trata de una instalación individual en la azotea o de un proyecto compartido en la comunidad. El espacio suele ser más limitado, por lo que se buscan soluciones muy eficientes. Aun así, es posible reducir una parte importante de la factura con una instalación bien diseñada.</p>

            <h3>Precio de placas solares para negocio o local comercial</h3>
            <p>En negocios y locales comerciales, el precio de la instalación de placas solares está muy ligado a los horarios de consumo. Como muchas empresas consumen más durante el día, aprovechan mejor la producción solar y recuperan la inversión antes. Una buena instalación fotovoltaica puede recortar de forma notable los costes fijos de electricidad.</p>
          </div>
        </details>

        <details class="sc5-faq-item">
          <summary class="sc5-faq-q">¿Es rentable el precio de las placas solares en tu caso?</summary>
          <div class="sc5-faq-a">
            <p>La verdadera pregunta no es sólo cuánto cuestan las placas solares, sino si son rentables para ti. Analizamos tu consumo, tu tarifa eléctrica y creamos el precio estimado de la instalación para calcular el tiempo de amortización. Así sabrás en cuántos años recuperarás la inversión y cuánto podrías ahorrar a partir de entonces.</p>

            <h3>En cuánto tiempo puedes amortizar tu instalación</h3>
            <p>El tiempo de amortización de una instalación de placas solares suele situarse entre 5 y 10 años, según el consumo y el precio final. Cuanto más alto sea tu gasto actual en luz, antes recuperarás la inversión. Nuestra simulación te muestra una estimación del plazo de amortización para que puedas decidir con datos.</p>

            <h3>Cuánto puedes ahorrar cada año en tu factura de luz</h3>
            <p>Con una instalación de placas solares bien dimensionada puedes reducir tu factura de luz entre un 50% y un 70%, e incluso llegar a factura 0. Ese ahorro anual es lo que hace que el precio de las placas solares sea rentable a medio plazo. Verlo en números te ayudará a entender el impacto real en tu bolsillo.</p>
          </div>
        </details>

        <details class="sc5-faq-item">
          <summary class="sc5-faq-q">¿Por qué pedir tu precio de placas solares con nosotros?</summary>
          <div class="sc5-faq-a">
            <p>Te ayudamos a calcular el precio de tus placas solares de forma clara, transparente y sin compromiso. Nuestro objetivo es que entiendas cada partida del presupuesto y sepas exactamente qué estás contratando. Te acompañamos desde el estudio inicial hasta la puesta en marcha de la instalación.</p>

            <ul>
              <li><strong>Estudio personalizado sin compromiso</strong></li>
              <li><strong>Financiación hasta 20 años</strong></li>
              <li><strong>Instalación en 24 horas</strong></li>
              <li><strong>Garantías de 25 años</strong></li>
            </ul>
          </div>
        </details>

        <details class="sc5-faq-item">
          <summary class="sc5-faq-q">Qué te pedimos en la calculadora (paso a paso)</summary>
          <div class="sc5-faq-a">
            <p>Responde a estas preguntas y te mostraremos un presupuesto orientativo para tu instalación de placas solares.</p>

            <div class="sc5-steps">
              <div class="sc5-step">
                <div class="sc5-step-tag">Vivienda</div>
                <h3>¿Qué tipo de vivienda es?</h3>
              </div>

              <div class="sc5-step">
                <div class="sc5-step-tag">Superficie</div>
                <h3>¿Cuántos m² útiles tienes para instalar placas?</h3>
                <p>Cuenta solo la zona libre de sombras y obstáculos (chimeneas, claraboyas, antenas, etc.).</p>
              </div>

              <div class="sc5-step">
                <div class="sc5-step-tag">Tejado</div>
                <h3>Orientación del tejado</h3>
                <p>¿Hacia dónde está orientada la zona donde irían las placas?</p>
                <p>La orientación influye en la producción solar y el ahorro.</p>
              </div>

              <div class="sc5-step">
                <div class="sc5-step-tag">Consumo</div>
                <h3>Consumo de electricidad</h3>
                <p>¿Cómo prefieres indicar tu consumo?</p>
                <ul>
                  <li>Importe medio de tu factura</li>
                  <li>kWh al año</li>
                </ul>
                <p><em>Si no lo tienes claro, una cifra aproximada nos sirve para calcular un presupuesto orientativo.</em></p>
              </div>

              <div class="sc5-step">
                <div class="sc5-step-tag">Ubicación</div>
                <h3>Provincia de la vivienda</h3>
                <p>¿En qué provincia está la vivienda?</p>
                <p><em>Nos permite estimar la radiación solar media y ajustar mejor el cálculo.</em></p>
              </div>

              <div class="sc5-step">
                <div class="sc5-step-tag">Contacto</div>
                <h3>Datos de contacto</h3>
                <p>Déjanos tus datos para mostrarte el presupuesto y enviártelo si lo deseas.</p>
                <ul>
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

  <div class="sc5-toast" id="sc-toast" role="status" aria-live="polite"></div>

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

      // Solo scroll si ya estás en la zona de calculadora
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
