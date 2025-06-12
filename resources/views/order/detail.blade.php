<div class="modal fade modal-xl" id="detailOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="exampleModalLabel">{{ __('word.order_detail') }}</h5> --}}
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-lg"
                    style="max-width: 800px; background: white; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); padding: 30px; margin: 20px auto;">
                    <!-- Header -->
                    <div class="text-center mb-2">
                        <h4 style="font-weight: 700; color: #2c3e50; margin-bottom: 5px;">ORDER RECEIPT</h4>
                        <div
                            style="height: 3px; background: linear-gradient(to right, #60db34, #cee13b); width: 200px; margin: 10px auto;">
                        </div>
                        <p style="color: #6c757d;">Thank you for your order!</p>
                    </div>

                    <!-- Order Info -->
                    <div class="row g-3 mb-2">
                        <div class="col-12 col-sm-12">
                            <div
                                style="background: #f8fafc; border-radius: 8px; padding: 15px; height: 100%; border-left: 4px solid #b4c640; box-shadow: 2px 2px 5px #0000000d;">
                                <p style="margin-bottom: 5px;"><strong>Status:</strong> <span class="badge"
                                        style="background-color: #fff3cd; color: #856404; font-weight: 500;">Pending</span>
                                </p>
                                <p style="margin-bottom: 5px;"><strong>Total Weight:</strong> 20.00 kg</p>
                                <p style="margin-bottom: 0;"><strong>Total Amount:</strong> $561.00</p>
                                <p style="margin-bottom: 5px;"><strong>Date:</strong> June 12, 2025</p>
                            </div>
                        </div>
                    </div>

                    <!-- Customer & Address -->
                    <div class="row g-3 mb-2">
                        <div class="col-12 col-md-12 col-sm-12 ">
                            <div
                                style="background: #f8fafc; border-radius: 8px; padding: 15px; height: 100%; border-left: 4px solid #b4c640; box-shadow: 2px 2px 5px #0000000d;">
                                <h5
                                    style="color: #2c3e50; font-size: 1.1rem; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                    <i class="bi bi-person-circle me-2"></i>Customer Information
                                </h5>
                                <p style="margin-bottom: 8px;"><strong>Name:</strong> Aniyah Pollich</p>
                                <p style="margin-bottom: 0;"><strong>Phone:</strong> +1-270-847-6633</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-sm-12 address-container">
                            <div
                                style="background: #f8fafc; border-radius: 8px; padding: 15px; height: 100%; border-left: 4px solid #b4c640; box-shadow: 2px 2px 5px #0000000d;">
                                <h5
                                    style="color: #2c3e50; font-size: 1.1rem; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                    <i class="bi bi-geo-alt me-2"></i>Address
                                </h5>
                                <address style="font-style: normal; line-height: 1.6; margin-bottom: 0;">
                                    123 Main Street,
                                    Suite 400,
                                    New York, NY 10001,
                                    United States
                                </address>
                            </div>
                        </div>
                    </div>

                    <!-- Order Details -->
                    <div
                        style="background: white; border-radius: 8px; padding: 20px; margin-bottom: 25px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
                        <h5
                            style="color: #2c3e50; font-size: 1.1rem; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                            <i class="bi bi-list-check me-2"></i>Order Details
                        </h5>
                        <div class="table-responsive">
                            <table class="table" style="margin-bottom: 0;">
                                <thead>
                                    <tr style="background-color: #f1f5f9;">
                                        <th style="font-weight: 600; width: 50%;">Description</th>
                                        <th style="font-weight: 600; text-align: right;">Weight</th>
                                        <th style="font-weight: 600; text-align: right;">Price/kg</th>
                                        <th style="font-weight: 600; text-align: right;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Product Shipment</td>
                                        <td style="text-align: right;">20.00 kg</td>
                                        <td style="text-align: right;">$28.07</td>
                                        <td style="text-align: right;">$561.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div style="text-align: center; margin-top: 20px; padding-top: 15px; border-top: 1px dashed #ddd;">
                        <p style="margin-bottom: 5px; color: #6c757d; font-size: 0.9rem;">For any questions, please
                            contact our customer service</p>
                        <p style="margin-bottom: 0; color: #6c757d; font-size: 0.9rem;">support@example.com | (123)
                            456-7890</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="printAddressLabels" class="btn btn-primary mt-3">
                    <i class="bi bi-printer"></i> Print Address Labels (10 per page)
                </button>
            </div>
        </div>
    </div>
</div>
