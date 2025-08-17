<!-- Contact Section -->
<section id="section4" class="py-5">
    <div class="container">
        <div class="row pb-3">
            <!-- Contact Form -->
            <div class="col-lg-6 col-md-12 mb-4">
                <h3 class="text-center pb-4 mt-2" data-aos="fade-up">Contáctanos</h3> 
                <form id="contactForm" action="https://formsubmit.co/gokay.yigit1998@gmail.com" method="post" data-aos="fade-up" data-aos-delay="200">
                    <!-- Name input -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="name">Nombre</label>
                        <input class="form-control" id="name" type="text" name="name" placeholder="Tu nombre completo" required />
                    </div>
            
                    <!-- Phone number input -->
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-bold">Número de Teléfono</label>
                        <input class="form-control" type="tel" id="phone" name="tel" placeholder="09-555-555-555" pattern="[0]{1}[0-9]{1}[0-9]{8}" required>
                    </div>
                    
                    <!-- Email address input -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="emailAddress">Dirección de Email</label>
                        <input class="form-control" id="emailAddress" type="email" name="e-mail" placeholder="tu@email.com" required data-sb-validations="email" />
                    </div>
            
                    <!-- Subject input -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="konu">Asunto</label>
                        <input class="form-control" id="konu" type="text" name="konu" placeholder="Asunto del mensaje" required />
                    </div>
            
                    <!-- Message input -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="message">Mensaje</label>
                        <textarea class="form-control" id="message" name="mesaj" placeholder="Escribe tu mensaje aquí..." rows="5" maxlength="500" required></textarea>
                        <div class="form-text">Máximo 500 caracteres</div>
                    </div>
                    
                    <!-- Disable captcha after sending mail -->
                    <input type="hidden" name="_captcha" value="false">
                    
                    <!-- Submit button -->
                    <div class="d-grid">
                        <button class="btn btn-form btn-lg" type="submit">
                            <i class="fas fa-paper-plane me-2"></i>Enviar Mensaje
                        </button>
                    </div>
                </form>
            </div>

            <!-- Map and contact info -->
            <div class="col-lg-6 col-md-12">
                <div class="h-100">
                    <h3 class="text-center pb-4 mt-2" data-aos="fade-up">Información de Contacto</h3>
                    
                    <!-- Contact Info Cards -->
                    <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-12 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-phone-alt fa-2x text-primary mb-2"></i>
                                    <h6 class="card-title">Teléfono</h6>
                                    <p class="card-text">+593 99 123 4567</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-map-marker-alt fa-2x text-primary mb-2"></i>
                                    <h6 class="card-title">Dirección</h6>
                                    <p class="card-text">Av. Amazonas y Naciones Unidas<br>Quito - Ecuador</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Map -->
                    <div class="map-container" data-aos="fade-up" data-aos-delay="400">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.817267982733!2d-78.48675878550506!3d-0.1807466999493457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d59a107ca3c5bd%3A0x2b2461b8be4c3c14!2sQuito%2C%20Ecuador!5e0!3m2!1ses!2sec!4v1641999600000!5m2!1ses!2sec" 
                                class="w-100 rounded" 
                                height="300" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Ubicación de Ray Tattoo Studio"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
