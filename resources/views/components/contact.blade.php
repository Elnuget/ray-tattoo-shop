<!-- Contact Section -->
<section id="section4">
    <div class="container">
        <div class="row pb-3">
            <!-- Contact Form -->
            <div class="col-md-6">
                <h3 class="text-center pb-5 py-3 mt-2" data-aos="fade-up">Contáctanos</h3> 
                <form id="contactForm" action="https://formsubmit.co/gokay.yigit1998@gmail.com" method="post">
                    <!-- Name input -->
                    <div class="mb-3">
                        <label class="form-label" for="name">Nombre</label>
                        <input class="form-control" id="name" type="text" name="name" placeholder="Nombre" required />
                    </div>
            
                    <!-- Phone number input -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Ingrese su Número de Teléfono</label>
                        <input class="form-control" type="tel" id="phone" name="tel" placeholder="09-555-555-555" pattern="[0]{1}[0-9]{1}[0-9]{8}" required>
                    </div>
                    
                    <!-- Email address input -->
                    <div class="mb-3">
                        <label class="form-label" for="emailAddress">Ingrese su Dirección de Email</label>
                        <input class="form-control" id="emailAddress" type="email" name="e-mail" placeholder="Dirección de Email" required data-sb-validations="email" />
                    </div>
            
                    <!-- Subject input -->
                    <div class="mb-3">
                        <label class="form-label" for="konu">Asunto</label>
                        <input class="form-control" id="konu" type="text" name="konu" placeholder="Asunto" required />
                    </div>
            
                    <!-- Message input -->
                    <div class="mb-3">
                        <label class="form-label" for="message">Mensaje</label>
                        <textarea class="form-control" id="message" type="text" name="mesaj" placeholder="Su Mensaje" maxlength="500" style="height: 10rem;" required></textarea>
                    </div>
                    
                    <!-- Disable captcha after sending mail -->
                    <input type="hidden" name="_captcha" value="false">
                    
                    <!-- Submit button -->
                    <button class="btn btn-form" type="submit">Enviar</button>
                </form>
            </div>

            <!-- Map and contact info -->
            <div class="col-md-6">
                <div class="container">
                    <div class="py-3">
                        <h3 class="text-center pb-5 mt-2" data-aos="fade-up">Información de Contacto</h3> 
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.817267982733!2d-78.48675878550506!3d-0.1807466999493457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d59a107ca3c5bd%3A0x2b2461b8be4c3c14!2sQuito%2C%20Ecuador!5e0!3m2!1ses!2sec!4v1641999600000!5m2!1ses!2sec" class="w-100" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="py-3">
                        <ul>
                            <li>Contacto: +593 99 123 4567</li>
                            <li>Nuestra Dirección: Av. Amazonas y Naciones Unidas, Quito - Ecuador</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
