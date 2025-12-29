<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calculadora de placas solares | Precio orientativo en 1 minuto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="Calcula el precio orientativo de tu instalación de placas solares en 1 minuto. Estimación según consumo, tejado, orientación, superficie y provincia.">

  <link rel="stylesheet" href="{{ asset('css/calculator-v2.css') }}">

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
  <main class="sc2-page">
    <div class="sc2-shell">

      {{-- HERO --}}
      <section class="sc2-hero" aria-labelledby="hero-title">
        <div class="sc2-hero-card">
          <h1 id="hero-title" class="sc2-h1">Calculadora de placas solares</h1>
          <p class="sc2-lead">Responde a unas preguntas y obtén una estimación orientativa de potencia, presupuesto y ahorro anual.</p>

          <div class="sc2-trust">
            <span class="sc2-pill">⏱️ 1 minuto</span>
            <span class="sc2-pill">📍 Ajuste por provincia</span>
            <span class="sc2-pill">🔒 Sin compromiso</span>
          </div>
        </div>
      </section>

      {{-- SEO CORTO --}}
      <section class="sc2-seo-top" aria-labelledby="seo-top-title">
        <header class="sc2-seo-head">
          <h2 id="seo-top-title" class="sc2-h2">Calcula el precio de tus placas solares</h2>
          <p class="sc2-muted">Te pedimos solo lo imprescindible para mostrarte un presupuesto orientativo para tu vivienda o negocio.</p>
        </header>

        <div class="sc2-grid">
          <article class="sc2-card">
            <div class="sc2-card-tag">Vivienda</div>
            <h3 class="sc2-h3">¿Qué tipo de vivienda es?</h3>
            <p class="sc2-muted">Casa, adosado, piso/ático, comunidad o empresa.</p>
          </article>

          <article class="sc2-card">
            <div class="sc2-card-tag">Superficie</div>
            <h3 class="sc2-h3">¿Cuántos m² útiles tienes?</h3>
            <p class="sc2-muted">Zona libre de sombras y obstáculos (chimeneas, claraboyas, antenas…).</p>
          </article>

          <article class="sc2-card">
            <div class="sc2-card-tag">Tejado</div>
            <h3 class="sc2-h3">Orientación y rendimiento</h3>
            <p class="sc2-muted">Influye directamente en producción y ahorro.</p>
          </article>

          <article class="sc2-card">
            <div class="sc2-card-tag">Consumo</div>
            <h3 class="sc2-h3">Factura o kWh/año</h3>
            <p class="sc2-muted">Con una cifra aproximada nos sirve para estimar.</p>
          </article>

          <article class="sc2-card">
            <div class="sc2-card-tag">Ubicación</div>
            <h3 class="sc2-h3">Provincia</h3>
            <p class="sc2-muted">Ajusta la radiación solar media y el cálculo.</p>
          </article>

          <article class="sc2-card">
            <div class="sc2-card-tag">Contacto</div>
            <h3 class="sc2-h3">Envío del resumen</h3>
            <p class="sc2-muted">Déjanos tus datos si quieres guardarlo o recibirlo.</p>
          </article>
        </div>
      </section>

      {{-- ERRORES LARAVEL --}}
      @if ($errors->any())
        <section class="sc2-alert" aria-label="Errores de formulario">
          <div class="sc2-alert-title">Revisa estos campos</div>
          <ul class="sc2-alert-list">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </section>
      @endif

      {{-- WIZARD --}}
      <section class="sc2-wizard" aria-labelledby="wizard-title">
        <h2 id="wizard-title" class="sc2-sr-only">Formulario de cálculo</h2>

        <form id="solar-form" method="POST" action="{{ route('calculator.store') }}" class="sc2-form">
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

          <div class="sc2-progress">
            <div class="sc2-progress-top">
              <div class="sc2-steptext" id="sc-steptext">Paso 1 de 10</div>
              <button type="button" class="sc2-link" id="sc-reset">Reiniciar</button>
            </div>
            <div class="sc2-bar" aria-hidden="true">
              <div class="sc2-bar-fill" id="sc-bar-fill" style="width:0%"></div>
            </div>
          </div>

          <div class="sc2-panels">

            <section class="sc2-panel active" data-step="1">
              <h3 class="sc2-q">¿Qué tipo de vivienda es?</h3>
              <p class="sc2-help">Selecciona una opción.</p>

              <div class="sc2-options" data-pick="tipo_vivienda">
                <button type="button" class="sc2-option" data-value="unifamiliar">Casa unifamiliar</button>
                <button type="button" class="sc2-option" data-value="adosado">Adosado / Pareado</button>
                <button type="button" class="sc2-option" data-value="piso">Piso / Ático</button>
                <button type="button" class="sc2-option" data-value="comunidad">Comunidad de vecinos</button>
                <button type="button" class="sc2-option" data-value="empresa">Empresa / Nave</button>
              </div>

              <div class="sc2-nav">
                <button type="button" class="sc2-btn ghost" disabled>Atrás</button>
                <button type="button" class="sc2-btn primary" data-next>Siguiente</button>
              </div>
            </section>

            <section class="sc2-panel" data-step="2">
              <h3 class="sc2-q">¿Cuánta superficie útil de tejado tienes?</h3>
              <p class="sc2-help">Aproximado. Si no lo sabes, pon una estimación.</p>

              <label class="sc2-field">
                <span class="sc2-label">Superficie útil (m²)</span>
                <input type="number" id="superficie_m2" name="superficie_m2" min="5" max="500" step="1"
                  placeholder="Ej: 60" value="{{ old('superficie_m2') }}">
              </label>

              <div class="sc2-nav">
                <button type="button" class="sc2-btn ghost" data-prev>Atrás</button>
                <button type="button" class="sc2-btn primary" data-next>Siguiente</button>
              </div>
            </section>

            <section class="sc2-panel" data-step="3">
              <h3 class="sc2-q">¿Cuál es la orientación principal del tejado?</h3>
              <p class="sc2-help">Selecciona una opción.</p>

              <div class="sc2-options" data-pick="orientacion">
                <button type="button" class="sc2-option" data-value="sur">Sur</button>
                <button type="button" class="sc2-option" data-value="sureste">Sureste</button>
                <button type="button" class="sc2-option" data-value="suroeste">Suroeste</button>
                <button type="button" class="sc2-option" data-value="este">Este</button>
                <button type="button" class="sc2-option" data-value="oeste">Oeste</button>
                <button type="button" class="sc2-option" data-value="norte">Norte</button>
              </div>

              <div class="sc2-nav">
                <button type="button" class="sc2-btn ghost" data-prev>Atrás</button>
                <button type="button" class="sc2-btn primary" data-next>Siguiente</button>
              </div>
            </section>

            <section class="sc2-panel" data-step="4">
              <h3 class="sc2-q">¿Cómo prefieres indicar tu consumo?</h3>
              <p class="sc2-help">Elige una opción.</p>

              <div class="sc2-options onecol" data-pick="consumo_modo">
                <button type="button" class="sc2-option" data-value="factura">Por importe de factura</button>
                <button type="button" class="sc2-option" data-value="kwh">Por kWh al año</button>
              </div>

              <div class="sc2-nav">
                <button type="button" class="sc2-btn ghost" data-prev>Atrás</button>
                <button type="button" class="sc2-btn primary" data-next>Siguiente</button>
              </div>
            </section>

            <section class="sc2-panel" data-step="5">
              <h3 class="sc2-q" id="sc-consumo-title">Indica tu consumo</h3>
              <p class="sc2-help" id="sc-consumo-help">Rellena el dato.</p>

              <label class="sc2-field" id="sc-field-factura">
                <span class="sc2-label">Factura mensual (€)</span>
                <input type="number" id="factura_mensual" name="factura_mensual" min="0" step="1"
                  placeholder="Ej: 85" value="{{ old('factura_mensual') }}">
              </label>

              <label class="sc2-field" id="sc-field-kwh">
                <span class="sc2-label">Consumo anual (kWh)</span>
                <input type="number" id="consumo_anual" name="consumo_anual" min="0" step="100"
                  placeholder="Ej: 4200" value="{{ old('consumo_anual') }}">
              </label>

              <p class="sc2-tip"><em>Si no lo tienes claro, una cifra aproximada nos sirve para calcular un presupuesto orientativo.</em></p>

              <div class="sc2-nav">
                <button type="button" class="sc2-btn ghost" data-prev>Atrás</button>
                <button type="button" class="sc2-btn primary" data-next>Siguiente</button>
              </div>
            </section>

            <section class="sc2-panel" data-step="6">
              <h3 class="sc2-q">¿En qué provincia está la vivienda?</h3>
              <p class="sc2-help">Esto ayuda a ajustar la estimación.</p>

              <label class="sc2-field">
                <span class="sc2-label">Provincia</span>
                <input type="text" id="provincia" name="provincia" placeholder="Ej: Madrid" value="{{ old('provincia') }}">
              </label>

              <div class="sc2-nav">
                <button type="button" class="sc2-btn ghost" data-prev>Atrás</button>
                <button type="button" class="sc2-btn primary" data-next>Siguiente</button>
              </div>
            </section>

            <section class="sc2-panel" data-step="7">
              <h3 class="sc2-q">¿Cuál es tu nombre?</h3>
              <p class="sc2-help">Lo usaremos para identificar tu solicitud.</p>

              <label class="sc2-field">
                <span class="sc2-label">Nombre</span>
                <input type="text" id="nombre" name="nombre" required autocomplete="name"
                  placeholder="Ej: Laura" value="{{ old('nombre') }}">
              </label>

              <div class="sc2-nav">
                <button type="button" class="sc2-btn ghost" data-prev>Atrás</button>
                <button type="button" class="sc2-btn primary" data-next>Siguiente</button>
              </div>
            </section>

            <section class="sc2-panel" data-step="8">
              <h3 class="sc2-q">¿Cuál es tu teléfono?</h3>
              <p class="sc2-help">Para contactarte si quieres afinar el estudio.</p>

              <label class="sc2-field">
                <span class="sc2-label">Teléfono</span>
                <input type="tel" id="telefono" name="telefono" required inputmode="tel" autocomplete="tel"
                  placeholder="Ej: 6XX XXX XXX" value="{{ old('telefono') }}">
              </label>

              <div class="sc2-nav">
                <button type="button" class="sc2-btn ghost" data-prev>Atrás</button>
                <button type="button" class="sc2-btn primary" data-next>Siguiente</button>
              </div>
            </section>

            <section class="sc2-panel" data-step="9">
              <h3 class="sc2-q">¿Cuál es tu email?</h3>
              <p class="sc2-help">Te enviaremos el resumen si lo necesitas.</p>

              <label class="sc2-field">
                <span class="sc2-label">Email</span>
                <input type="email" id="email" name="email" required autocomplete="email"
                  placeholder="Ej: nombre&#64;correo.com" value="{{ old('email') }}">
              </label>

              <label class="sc2-check">
                <input type="checkbox" name="consent_contacto" required>
                <span>Acepto que me contactéis para recibir información sobre la instalación fotovoltaica.</span>
              </label>

              <p class="sc2-legal">Tus datos se utilizarán únicamente para atender tu solicitud, según la política de privacidad.</p>

              <div class="sc2-nav">
                <button type="button" class="sc2-btn ghost" data-prev>Atrás</button>
                <button type="button" class="sc2-btn primary" data-next>Ver resultado</button>
              </div>
            </section>

            <section class="sc2-panel" data-step="10">
              <h3 class="sc2-q">Tu resultado orientativo</h3>
              <p class="sc2-help">Estimación basada en los datos introducidos.</p>

              <div class="sc2-result">
                <div class="sc2-result-main" id="result-titulo">Instalación estimada: — kWp</div>
                <div class="sc2-result-sub" id="result-precio">Presupuesto orientativo: — €</div>

                <div class="sc2-result-tags">
                  <span class="sc2-tag" id="result-placas">— paneles</span>
                  <span class="sc2-tag" id="result-ahorro">Ahorro estimado: — €/año</span>
                </div>

                <div class="sc2-note">Cifra orientativa. El precio final se ajusta con un estudio técnico.</div>
              </div>

              <div class="sc2-nav">
                <button type="button" class="sc2-btn ghost" data-prev>Atrás</button>
                <button type="submit" class="sc2-btn primary">Enviar solicitud</button>
              </div>
            </section>

          </div>
        </form>
      </section>

      <section class="sc2-seo-bottom" aria-labelledby="seo-bottom-title">
        <h2 id="seo-bottom-title" class="sc2-h2">Calcula el precio de tus placas solares en 1 minuto</h2>

        <details class="sc2-details">
          <summary class="sc2-summary">
            ¿Cómo calculamos el precio de tus placas solares?
            <span class="sc2-summary-hint">Ver más</span>
          </summary>

          <div class="sc2-content">
            <p>El precio de tus placas solares lo calculamos a partir de tu consumo de luz, la orientación de tu tejado y el tipo de residencia. Cruzamos estos datos con costes habituales de equipos y mano de obra para obtener un precio orientativo ajustado.</p>
          </div>
        </details>
      </section>

      <footer class="sc2-footer">
        <p class="sc2-muted">© {{ date('Y') }} · Calculadora orientativa de autoconsumo.</p>
      </footer>

    </div>
  </main>

  <div class="sc2-toast" id="sc-toast" role="status" aria-live="polite"></div>

  <script>
  (function () {
    const totalSteps = 10;
    let currentStep = 1;

    const form = document.getElementById('solar-form');
    const panels = document.querySelectorAll('.sc2-panel');
    const stepText = document.getElementById('sc-steptext');
    const barFill = document.getElementById('sc-bar-fill');
    const toastEl = document.getElementById('sc-toast');

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

    function showStep(step){
      currentStep = step;
      panels.forEach(p => p.classList.toggle('active', parseInt(p.dataset.step, 10) === step));
      setProgress(step);

      if (step === 5) paintConsumoStep();
      if (step === 10) calcularResultado();

      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function paintSelection(groupEl, hiddenEl){
      const v = hiddenEl.value;
      groupEl.querySelectorAll('.sc2-option').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.value === v);
      });
    }

    function paintAllSelections(){
      document.querySelectorAll('.sc2-options[data-pick]').forEach(group => {
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
        const activePanel = document.querySelector('.sc2-panel[data-step="' + step + '"]');
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

    document.querySelectorAll('.sc2-options[data-pick]').forEach(group => {
      group.addEventListener('click', (e) => {
        const btn = e.target.closest('.sc2-option');
        if (!btn) return;

        const pickName = group.getAttribute('data-pick');
        const hidden = document.getElementById(pickName);
        if (!hidden) return;

        hidden.value = btn.dataset.value;
        paintSelection(group, hidden);

        const panel = btn.closest('.sc2-panel');
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
    });

    function calcularResultado() {
      const superficie = parseFloat(document.getElementById('superficie_m2').value) || 0;
      const factura = parseFloat(document.getElementById('factura_mensual').value) || 0;
      const consumoInput = parseFloat(document.getElementById('consumo_anual').value) || 0;
      const orientacion = (document.getElementById('orientacion').value || 'sur');

      let consumo = consumoInput;

      const kwpPorM2 = 0.18;
      const potenciaPorSuperficie = superficie * kwpPorM2;

      if (!consumo && factura) {
        consumo = (factura * 12) / 0.20;
      }

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

<style>
  :root{
  --bg:#f6f7fb;
  --card:#ffffff;
  --text:#111827;
  --muted:#6b7280;
  --line:rgba(17,24,39,.10);
  --shadow: 0 10px 30px rgba(0,0,0,.06);
  --radius: 18px;
}

*{ box-sizing:border-box; }
body{
  margin:0;
  font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
  color:var(--text);
  background:var(--bg);
}

.sc2-page{ padding: 18px; }
.sc2-shell{ max-width: 980px; margin: 0 auto; }

/* HERO */
.sc2-hero-card{
  background: linear-gradient(180deg, #ffffff, #ffffff);
  border: 1px solid var(--line);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 22px;
}

.sc2-h1{ margin:0 0 8px; font-size: 2rem; }
.sc2-lead{ margin:0; color:var(--muted); line-height:1.55; }

.sc2-trust{ display:flex; gap:10px; flex-wrap:wrap; margin-top:14px; }
.sc2-pill{
  border: 1px solid var(--line);
  background: rgba(255,255,255,.8);
  padding: 6px 10px;
  border-radius: 999px;
  font-size: .92rem;
}

.sc2-h2{ margin: 18px 0 8px; font-size: 1.35rem; }
.sc2-h3{ margin: 10px 0 6px; font-size: 1.05rem; }
.sc2-muted{ color: var(--muted); line-height: 1.55; margin: 0; }

.sc2-seo-top, .sc2-wizard, .sc2-seo-bottom{
  margin-top: 16px;
}

.sc2-seo-head{
  padding: 0 4px;
}

/* CARDS SEO TOP */
.sc2-grid{
  display:grid;
  grid-template-columns: repeat(12, 1fr);
  gap: 12px;
  margin-top: 12px;
}

.sc2-card{
  grid-column: span 12;
  background: var(--card);
  border: 1px solid var(--line);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 14px 14px;
}
@media(min-width:768px){
  .sc2-card{ grid-column: span 6; }
}

.sc2-card-tag{
  display:inline-flex;
  padding: 4px 10px;
  border-radius: 999px;
  border: 1px solid var(--line);
  background: rgba(17,24,39,.03);
  font-size: .85rem;
  color: var(--text);
}

/* ALERT */
.sc2-alert{
  margin-top: 14px;
  background: #fff7ed;
  border: 1px solid rgba(234,88,12,.25);
  border-radius: var(--radius);
  padding: 14px;
}
.sc2-alert-title{ font-weight:700; margin-bottom: 8px; }
.sc2-alert-list{ margin:0; padding-left: 18px; }

/* FORM CONTAINER */
.sc2-form{
  background: var(--card);
  border: 1px solid var(--line);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 16px;
}

/* PROGRESS */
.sc2-progress-top{
  display:flex;
  align-items:center;
  justify-content: space-between;
  gap: 10px;
  margin-bottom: 10px;
}
.sc2-steptext{ color: var(--muted); font-weight: 600; }
.sc2-link{
  border: none;
  background: transparent;
  color: var(--text);
  text-decoration: underline;
  cursor:pointer;
}

.sc2-bar{
  height: 10px;
  background: rgba(17,24,39,.06);
  border-radius: 999px;
  overflow:hidden;
}
.sc2-bar-fill{
  height: 100%;
  width:0%;
  background: rgba(17,24,39,.75);
  border-radius: 999px;
  transition: width .25s ease;
}

/* PANELS */
.sc2-panel{ display:none; padding: 14px 2px 4px; }
.sc2-panel.active{ display:block; }

.sc2-q{ margin: 0 0 6px; font-size: 1.2rem; }
.sc2-help{ margin: 0 0 12px; color: var(--muted); }

/* OPTIONS */
.sc2-options{
  display:grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
}
.sc2-options.onecol{ grid-template-columns: 1fr; }

.sc2-option{
  border: 1px solid var(--line);
  background: #fff;
  border-radius: 14px;
  padding: 12px 12px;
  cursor: pointer;
  text-align:left;
  transition: transform .05s ease, border-color .2s ease, box-shadow .2s ease;
}
.sc2-option:hover{ transform: translateY(-1px); }
.sc2-option.active{
  border-color: rgba(17,24,39,.35);
  box-shadow: 0 6px 18px rgba(0,0,0,.06);
}

/* FIELDS */
.sc2-field{ display:block; margin-top: 10px; }
.sc2-label{ display:block; font-weight: 600; margin-bottom: 6px; }
.sc2-field input{
  width:100%;
  border: 1px solid var(--line);
  border-radius: 14px;
  padding: 12px 12px;
  font-size: 1rem;
  outline: none;
}
.sc2-field input:focus{
  border-color: rgba(17,24,39,.35);
}

.sc2-tip{ margin: 10px 0 0; color: var(--muted); }

/* CHECK */
.sc2-check{
  display:flex;
  gap: 10px;
  align-items:flex-start;
  margin-top: 10px;
  color: var(--text);
}
.sc2-legal{ margin-top: 8px; color: var(--muted); font-size: .95rem; }

/* NAV BUTTONS */
.sc2-nav{
  display:flex;
  justify-content: space-between;
  gap: 10px;
  margin-top: 16px;
}
.sc2-btn{
  border-radius: 14px;
  padding: 12px 14px;
  font-weight: 700;
  cursor:pointer;
  border: 1px solid var(--line);
  background: #fff;
  width: 48%;
}
.sc2-btn.primary{
  background: rgba(17,24,39,.92);
  color: #fff;
  border-color: rgba(17,24,39,.92);
}
.sc2-btn.ghost{
  background: #fff;
  color: var(--text);
}
.sc2-btn:disabled{ opacity:.5; cursor:not-allowed; }

/* RESULT */
.sc2-result{
  border: 1px solid var(--line);
  border-radius: var(--radius);
  padding: 14px;
  background: rgba(17,24,39,.02);
}
.sc2-result-main{ font-weight: 800; font-size: 1.2rem; }
.sc2-result-sub{ margin-top: 6px; color: var(--muted); font-weight: 700; }
.sc2-result-tags{ margin-top: 12px; display:flex; gap: 10px; flex-wrap:wrap; }
.sc2-tag{
  border: 1px solid var(--line);
  background:#fff;
  padding: 6px 10px;
  border-radius: 999px;
}
.sc2-note{ margin-top: 10px; color: var(--muted); }

/* DETAILS SEO */
.sc2-details{
  background: var(--card);
  border: 1px solid var(--line);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  overflow:hidden;
}
.sc2-summary{
  padding: 14px 14px;
  cursor:pointer;
  display:flex;
  justify-content: space-between;
  gap: 10px;
  font-weight: 800;
}
.sc2-summary-hint{ color: var(--muted); font-weight: 600; }
.sc2-content{ padding: 0 14px 14px; }
.sc2-content p{ margin: 0 0 10px; color: var(--muted); line-height: 1.55; }

/* FOOTER */
.sc2-footer{
  margin: 18px 0 0;
  padding: 10px 4px;
}

/* TOAST */
.sc2-toast{
  position: fixed;
  left: 50%;
  bottom: 18px;
  transform: translateX(-50%);
  background: rgba(17,24,39,.92);
  color: #fff;
  padding: 10px 14px;
  border-radius: 999px;
  opacity: 0;
  pointer-events: none;
  transition: opacity .2s ease;
}
.sc2-toast.show{ opacity: 1; }

/* SR ONLY */
.sc2-sr-only{
  position:absolute !important;
  width:1px; height:1px;
  padding:0; margin:-1px;
  overflow:hidden; clip:rect(0,0,0,0);
  white-space:nowrap; border:0;
}

</style>
