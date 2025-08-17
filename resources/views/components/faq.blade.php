<!-- FAQ Section -->
<section id="section3" class="faq-section py-5">
    <h3 class="text-center mb-5">Preguntas Frecuentes</h3>
    <div class="container">
        <div class="row py-3">
            <div class="col-6">
                <div class="accordion" id="accordionExamples">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-{{ ['one', 'two', 'three', 'four', 'five'][$i-1] }}">Pregunta {{ $i }}</button>
                            </h2>
                            <div id="accordion-{{ ['one', 'two', 'three', 'four', 'five'][$i-1] }}" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-6">
                <div class="accordion" id="accordionExamples">
                    @for($i = 6; $i <= 10; $i++)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-{{ ['six', 'seven', 'eight', 'nine', 'ten'][$i-6] }}">Pregunta {{ $i }}</button>
                            </h2>
                            <div id="accordion-{{ ['six', 'seven', 'eight', 'nine', 'ten'][$i-6] }}" class="accordion-collapse collapse" data-bs-parent="#accordionExamples">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
