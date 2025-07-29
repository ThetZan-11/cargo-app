<div class="modal fade modal-xl" id="detailOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-lg"
                    style="max-width: 800px; background: white; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); padding: 30px; margin: 20px auto;">
                    <!-- Header -->
                    <div class="mb-2 text-center">
                        <h4 style="font-weight: 700; color: #2c3e50; margin-bottom: 5px;">{{ __('word.order_receipt') }}
                        </h4>
                        <div
                            style="height: 3px; background: linear-gradient(to right, #60db34, #cee13b); width: 200px; margin: 10px auto;">
                        </div>
                    </div>

                    <!-- Order Info -->
                    <div class="row g-3 mb-2">
                        <div class="col-12 col-sm-12">
                            <div
                                style="background: #f8fafc; border-radius: 8px; padding: 15px; height: 100%; border-left: 4px solid #b4c640; box-shadow: 2px 2px 5px #0000000d;">

                                <p style="margin-bottom: 5px;"><strong>{{ __('word.total_weight') }}:</strong> <span
                                        id="total_kg_detail"></span>
                                </p>
                                <p style="margin-bottom: 5px;"><strong>{{ __('word.price_per_kg') }}</strong> <span
                                        id="price_per_kg"></span>
                                </p>
                                <p style="margin-bottom: 0;"><strong>{{ __('word.total_amount') }}:</strong>
                                    <span id="total_amount_detail"></span>
                                </p>

                                <p style="margin-bottom: 5px;"><strong>{{ __('word.date') }}:</strong> <span
                                        id="order_date_detail"></span> </p>
                                <p style="margin-bottom: 5px;"><strong>{{ __('word.arp_no') }}:</strong> <span
                                        id="arp_no_detail"></span>

                            </div>
                        </div>
                    </div>

                    <!-- Customer & Address -->
                    <div class="row g-3 mb-2">
                        <div class="col-12 col-md-12 col-sm-12">
                            <div
                                style="background: #f8fafc; border-radius: 8px; padding: 15px; height: 100%; border-left: 4px solid #b4c640; box-shadow: 2px 2px 5px #0000000d;">
                                <h5
                                    style="color: #2c3e50; font-size: 1.1rem; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                    <i class="bi bi-person-circle me-2"></i>{{ __('word.customer_information') }}
                                </h5>
                                <p style="margin-bottom: 8px;"><strong>{{ __('word.name') }}:</strong> <span
                                        id="name_detail"></span></p>
                                <p style="margin-bottom: 0;"><strong>{{ __('word.phone') }}:</strong> <span
                                        id="phone_detail"></span></p>
                                <p style="margin-bottom: 0;"><strong>{{ __('word.sender_name') }}:</strong> <span
                                        id="sender_name_detail"></span></p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 address-container">
                            <div
                                style="background: #f8fafc; border-radius: 8px; padding: 15px; height: 100%; border-left: 4px solid #b4c640; box-shadow: 2px 2px 5px #0000000d;">
                                <h5
                                    style="color: #2c3e50; font-size: 0.8rem; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                    <i class="bi bi-geo-alt me-2"></i>{{ __('word.address') }}
                                </h5>
                                <address style="font-style: normal; line-height: 1.6; margin-bottom: 0;"
                                    id="address_detail">
                                </address>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 address-container">
                            <div
                                style="background: #f8fafc; border-radius: 8px; padding: 15px; height: 100%; border-left: 4px solid #b4c640; box-shadow: 2px 2px 5px #0000000d;">
                                <h5
                                    style="color: #2c3e50; font-size: 0.8rem; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                    <i class="bi bi-geo-alt me-2"></i>{{ __('word.sender_address') }}
                                </h5>
                                <address style="font-style: normal; line-height: 1.6; margin-bottom: 0;"
                                    id="sender_address_detail">
                                </address>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 desc-container">
                            <div
                                style="background: #f8fafc; border-radius: 8px; padding: 15px; height: 100%; border-left: 4px solid #b4c640; box-shadow: 2px 2px 5px #0000000d;">
                                <h5
                                    style="color: #2c3e50; font-size: 0.8rem; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center;">
                                    <i class="bi bi-geo-alt me-2"></i>{{ __('word.description') }}
                                </h5>
                                <address style="font-style: normal; line-height: 1.6; margin-bottom: 0;"
                                    id="description_detail">
                                </address>
                            </div>
                        </div>
                    </div>
                    <!-- RECEIPT DESIGN START -->

                    <div class="receipt-paper" id="receipt-section"
                        style="max-width: 1000px; margin: 20px auto; background: #f8f66b; border: 1px solid #ebeb91; border-radius: 10px; box-shadow: 0 2px 8px #0001; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif; overflow-x: auto;">
                        <div class="receipt-header d-flex justify-content-between align-items-center">
                            <h1 style="font-size: 40px; font-weight:900; font-family: Libertinus Math,system-ui;">
                                Juu Air Cargo
                            </h1>
                            <div>
                                <img src="{{ asset('assets/img/juu.png') }}" alt="logo" class="img-fluid"
                                    style="max-height:150px;">
                            </div>

                        </div>
                        <div class="address-card mb-2 p-3 text-center"
                            style="font-weight: 700; font-size: 15px; background: #fff; border-radius: 10px; color: #3b5c7f;">
                            အမှတ်(၃/ခ) ဘောဂမြင့်မိုရ် (၂)လမ်းသွယ်၊ မြောက်ဥက္ကလာပမြို့နယ်၊ ရန်ကုန်မြို့။
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <div><strong>အမည် :</strong> <span id="name_receipt"></span></div>
                            <div><strong>နိုင်ငံ:</strong> <span id="country_receipt"></span></div>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <div><strong>ရက်စွဲ :</strong> <span id="order_date_receipt"></span></div>
                            <div><strong>ဖုန်း :</strong> <span id="phone_receipt"></span></div>
                        </div>
                        <div style="overflow-x: auto; width: 100%;" id="table-receipt">
                            <table class="table-bordered receipt-table table"
                                style="background: #fff; border-color: #e2e2b0; width:100%; white-space: nowrap;">
                                <thead style="background: #e4e480;">
                                    <tr class="text-center">
                                        <th style="width: 20px;">စဉ်</th>
                                        <th>အမျိုးအမည်</th>
                                        <th>အရေအတွက်</th>
                                        <th>ဈေးနှုန်း</th>
                                        <th>သင့်ငွေ</th>
                                    </tr>
                                </thead>
                                <tbody id="order_details_container">
                                    <!-- Order items will be injected here by JS -->

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>စုစုပေါင်း</strong></td>
                                        <td class="text-end"><strong><span id="total_kg_receipt"></span></strong></td>
                                        <td><strong><span></span></strong></td>
                                        <td class="text-end"><strong><span id="total_amount_receipt"></span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="mx-auto" id="footer-receipt"
                            style="display: flex; justify-content: space-between; align-items: center; margin-top: 18px;">
                            <div class="greeting">
                                မှာယူအားပေးမှုအတွက် ကျေးဇူးတင်ပါသည်။
                                <i class="fa-regular fa-face-laugh-wink"></i>
                            </div>
                            <div class="sign" style="font-size: 0.95rem; color: #888;">လက်မှတ် ____________________
                            </div>
                        </div>
                        <div id="address-container" class="mt-3 p-3 text-center"
                            style="background-color: #ffffff; border-radius:10px; color: #e85555; font-weight: 600; font-size: 1rem;">
                            <i class="fa-solid fa-triangle-exclamation"></i> တားမြစ်ပစ္စည်းများ ခိုးဝှက်တွေ့ရှိပါက
                            တာဝန်မယူပါ။ <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                    </div>
                    <!-- RECEIPT DESIGN END -->
                    <button id="print-receipt-btn" class="btn btn-primary mt-3" type="button"
                        onclick="printReceipt()"><i class="fa fa-print"></i> {{ __('word.print_receipt') }}</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-ripple-init
                    data-mdb-dismiss="modal">{{ __('word.cancel') }}</button>
            </div>
        </div>
    </div>
</div>
