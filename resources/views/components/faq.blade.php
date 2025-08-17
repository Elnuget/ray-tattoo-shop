<!-- FAQ Section -->
<section id="section3" class="faq-section py-5">
    <div class="container">
        <h3 class="text-center mb-5" data-aos="fade-down">Preguntas Frecuentes</h3>
        <div class="row py-3">
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="accordion" id="accordionExamplesLeft">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                            <h2 class="accordion-header">
                                <button type="button" class="accordion-button collapsed" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#accordion-{{ ['one', 'two', 'three', 'four', 'five'][$i-1] }}"
                                        aria-expanded="false"
                                        aria-controls="accordion-{{ ['one', 'two', 'three', 'four', 'five'][$i-1] }}">
                                    Pregunta {{ $i }}
                                </button>
                            </h2>
                            <div id="accordion-{{ ['one', 'two', 'three', 'four', 'five'][$i-1] }}" 
                                 class="accordion-collapse collapse" 
                                 data-bs-parent="#accordionExamplesLeft">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, id.</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="accordion" id="accordionExamplesRight">
                    @for($i = 6; $i <= 10; $i++)
                        <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="{{ ($i - 5) * 100 }}">
                            <h2 class="accordion-header">
                                <button type="button" class="accordion-button collapsed" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#accordion-{{ ['six', 'seven', 'eight', 'nine', 'ten'][$i-6] }}"
                                        aria-expanded="false"
                                        aria-controls="accordion-{{ ['six', 'seven', 'eight', 'nine', 'ten'][$i-6] }}">
                                    Pregunta {{ $i }}
                                </button>
                            </h2>
                            <div id="accordion-{{ ['six', 'seven', 'eight', 'nine', 'ten'][$i-6] }}" 
                                 class="accordion-collapse collapse" 
                                 data-bs-parent="#accordionExamplesRight">
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
