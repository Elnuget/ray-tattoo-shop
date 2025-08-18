<!-- Contact Section -->
<section id="section4" class="py-5">
    <div class="container">
        <div class="row pb-3">
            <!-- Contact Form -->
            <div class="col-lg-6 col-md-12 mb-4">
                <h3 class="text-center pb-4 mt-2" data-aos="fade-up">Contáctanos</h3> 
                <div id="contactForm" data-aos="fade-up" data-aos-delay="200">
                    <!-- Name input -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="name">Nombre</label>
                        <input class="form-control" id="name" type="text" name="name" placeholder="Tu nombre completo" required />
                    </div>
            
                    <!-- Message input -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="message">Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="5" maxlength="500" required>Deseo cotizar un tatuaje</textarea>
                        <div class="form-text">Máximo 500 caracteres</div>
                    </div>
                    
                    <!-- WhatsApp button -->
                    <div class="d-grid">
                        <button class="btn btn-success btn-lg" type="button" onclick="sendWhatsApp()">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </button>
                    </div>
                </div>
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
                                    <p class="card-text">+593 99 590 1750</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-map-marker-alt fa-2x text-primary mb-2"></i>
                                    <h6 class="card-title">Dirección</h6>
                                    <p class="card-text">Pinar Bajo<br>Quito - Ecuador</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Map -->
                    <div class="map-container" data-aos="fade-up" data-aos-delay="400">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.804473537504!2d-78.49716157411382!3d-0.15095099984755983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d59ab429a8e671%3A0xc15058be59bc26d5!2sEl%20pinar%20Bajo%2C%20170104%20Quito!5e0!3m2!1ses!2sec!4v1755478064570!5m2!1ses!2sec" 
                                class="w-100 rounded" 
                                height="300" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Ubicación de ROTO Tattoo Studio - Pinar Bajo"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function sendWhatsApp() {
    const name = document.getElementById('name').value;
    const message = document.getElementById('message').value;
    
    if (!name.trim()) {
        alert('Por favor, ingresa tu nombre');
        return;
    }
    
    if (!message.trim()) {
        alert('Por favor, ingresa un mensaje');
        return;
    }
    
    const whatsappMessage = `Hola, soy ${name}. ${message}`;
    const whatsappNumber = '593995901750'; // Número sin signos + ni espacios
    const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(whatsappMessage)}`;
    
    window.open(whatsappUrl, '_blank');
}
</script>
