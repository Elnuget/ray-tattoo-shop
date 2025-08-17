<!-- Gallery Modals -->
<section>
    @for($i = 1; $i <= 12; $i++)
        <div class="portfolio-modal modal fade mt-5" id="portfoliomodal{{ $i == 1 ? '' : $i }}" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content text-center">
                    <div class="modal-body text-center">
                        <div class="container-fluid py-3">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <img src="images/{{ $i }}.jpg" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endfor
</section>
