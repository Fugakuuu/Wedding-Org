<x-public-layout title="Booking - {{ $paket->Nama_paket }}">
    <div class="w-full flex justify-center bg-stone-50 min-h-screen">
        <div data-layer="Main - Konten Utama: 1 Kolom Bersih & To-the-point" class="w-full max-w-[1280px] px-4 sm:px-16 md:px-72 py-10 inline-flex flex-col justify-start items-center">
            <div data-layer="Container" class="Container w-full max-w-[672px] flex flex-col justify-start items-start gap-6">
                
                {{-- BACK LINK --}}
                <div data-layer="Back Link Simpel" class="BackLinkSimpel self-stretch pb-[3px] flex flex-col justify-start items-start">
                    <a href="{{ route('katalog') }}" data-layer="Link" class="Link size- inline-flex justify-start items-center gap-1.5 hover:opacity-80">
                        <div data-layer="Container" class="Container size- inline-flex flex-col justify-start items-start">
                            <div data-layer="Icon" class="Icon size-3 bg-stone-700"></div>
                        </div>
                        <div data-layer="Container" class="Container size- inline-flex flex-col justify-start items-start">
                            <div data-layer="Text" class="Text justify-center text-stone-700 text-base font-normal font-['Inter'] leading-6">Kembali ke Katalog Paket</div>
                        </div>
                    </a>
                </div>

                {{-- JUDUL --}}
                <div data-layer="Judul Bersih" class="JudulBersih self-stretch flex flex-col justify-start items-start gap-1.5">
                    <div data-layer="Heading 1" class="Heading1 self-stretch flex flex-col justify-start items-start">
                        <div data-layer="Form Pemesanan Paket Wedding" class="FormPemesananPaketWedding self-stretch justify-center text-neutral-900 text-base font-medium font-['Playfair_Display'] leading-6">Form Pemesanan Paket Wedding</div>
                    </div>
                    <div data-layer="Container" class="Container self-stretch flex flex-col justify-start items-start">
                        <div data-layer="Lengkapi data di bawah ini untuk reservasi tanggal pernikahan Anda." class="LengkapiDataDiBawahIniUntukReservasiTanggalPernikahanAnda self-stretch justify-center text-stone-700 text-base font-normal font-['Inter'] leading-6">Lengkapi data di bawah ini untuk reservasi tanggal pernikahan Anda.</div>
                    </div>
                </div>

                {{-- FORM --}}
                <form method="POST" action="{{ route('booking.store') }}" data-layer="Form Card Ultra-Clean" class="FormCardUltraClean self-stretch px-4 sm:px-8 pt-10 pb-8 bg-white rounded-lg shadow-[0px_1px_2px_0px_rgba(0,0,0,0.05)] outline outline-1 outline-offset-[-1px] outline-stone-300/60 flex flex-col justify-start items-start gap-5">
                    @csrf
                    <input type="hidden" name="Paket_id" value="{{ $paket->Paket_id }}">

                    <div data-layer="Pilihan Paket (Dropdown)" class="PilihanPaketDropdown self-stretch flex flex-col justify-start items-start gap-1.5">
                        <div data-layer="Label" class="Label self-stretch flex flex-col justify-start items-start">
                            <div data-layer="Pilihan Paket *" class="PilihanPaket self-stretch justify-center"><span class="text-neutral-900 text-base font-semibold font-['Inter'] leading-6">Pilihan Paket </span><span class="text-red-700 text-base font-semibold font-['Inter'] leading-6">*</span></div>
                        </div>
                        <div data-layer="Container" class="Container self-stretch relative flex flex-col justify-start items-start">
                            <div data-layer="Options" class="Options self-stretch px-3.5 py-3 bg-stone-50 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300 inline-flex justify-center items-center">
                                <div data-layer="Container" class="Container flex-1 inline-flex flex-col justify-start items-start">
                                    <div class="self-stretch justify-center text-neutral-900 text-base font-normal font-['Inter'] leading-6">{{ $paket->Nama_paket }} - Rp {{ number_format($paket->Harga, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div data-layer="Nama Pemesan" class="NamaPemesan self-stretch flex flex-col justify-start items-start gap-1.5">
                        <div data-layer="Label" class="Label self-stretch flex flex-col justify-start items-start">
                            <div data-layer="Nama Pemesan *" class="NamaPemesan self-stretch justify-center"><span class="text-neutral-900 text-base font-semibold font-['Inter'] leading-6">Nama Pemesan </span><span class="text-red-700 text-base font-semibold font-['Inter'] leading-6">*</span></div>
                        </div>
                        <div data-layer="Input" class="Input self-stretch bg-stone-50 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300 flex justify-center items-center overflow-hidden focus-within:outline-neutral-900">
                            <input type="text" name="Nama_pemesan" value="{{ old('Nama_pemesan') }}" required
                                   class="flex-1 px-3.5 py-3 bg-transparent border-none outline-none focus:ring-0 text-neutral-900 text-base font-normal font-['Inter'] placeholder:text-stone-500/60 w-full"
                                   placeholder="Contoh: Raditya & Adinda">
                        </div>
                        @error('Nama_pemesan') <p class="text-sm text-red-600 w-full text-left">{{ $message }}</p> @enderror
                    </div>

                    <div data-layer="Email (Identitas Utama Approval)" class="EmailIdentitasUtamaApproval self-stretch flex flex-col justify-start items-start gap-1">
                        <div data-layer="Container" class="Container self-stretch flex justify-between items-center">
                            <div data-layer="Label" class="Label flex-1 flex flex-col justify-start items-start">
                                <div data-layer="Text" class="Text justify-center"><span class="text-neutral-900 text-base font-semibold font-['Inter'] leading-6">Alamat Email </span><span class="text-red-700 text-base font-semibold font-['Inter'] leading-6">*</span></div>
                            </div>
                            <div data-layer="Container" class="Container inline-flex flex-col justify-start items-end">
                                <div data-layer="Text" class="Text justify-center text-stone-600 text-sm sm:text-base font-medium font-['Inter'] leading-6">Identitas Utama Approval</div>
                            </div>
                        </div>
                        <div data-layer="Input" class="Input self-stretch bg-stone-50 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300 flex justify-center items-center overflow-hidden focus-within:outline-neutral-900">
                            <input type="email" name="Email_pemesan" value="{{ old('Email_pemesan') }}" required
                                   class="flex-1 px-3.5 py-3 bg-transparent border-none outline-none focus:ring-0 text-neutral-900 text-base font-normal font-['Inter'] placeholder:text-stone-500/60 w-full"
                                   placeholder="nama.kalian@email.com">
                        </div>
                        <div data-layer="Container" class="Container self-stretch flex flex-col justify-start items-start">
                            <div data-layer="Konfirmasi..." class="self-stretch justify-start text-stone-500 text-sm sm:text-base font-normal font-['Inter'] leading-6">Konfirmasi dan status persetujuan (approval) pemesanan akan otomatis dikirim ke email ini.</div>
                        </div>
                        @error('Email_pemesan') <p class="text-sm text-red-600 w-full text-left">{{ $message }}</p> @enderror
                    </div>

                    <div data-layer="WhatsApp / Telepon" class="WhatsappTelepon self-stretch flex flex-col justify-start items-start gap-1.5">
                        <div data-layer="Label" class="Label self-stretch flex flex-col justify-start items-start">
                            <div data-layer="No. WhatsApp / Telepon *" class="NoWhatsappTelepon self-stretch justify-center"><span class="text-neutral-900 text-base font-semibold font-['Inter'] leading-6">No. WhatsApp / Telepon </span><span class="text-red-700 text-base font-semibold font-['Inter'] leading-6">*</span></div>
                        </div>
                        <div data-layer="Input" class="Input self-stretch bg-stone-50 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300 flex justify-center items-center overflow-hidden focus-within:outline-neutral-900">
                            <input type="text" name="No_WA" value="{{ old('No_WA') }}" required
                                   class="flex-1 px-3.5 py-3 bg-transparent border-none outline-none focus:ring-0 text-neutral-900 text-base font-normal font-['Inter'] placeholder:text-stone-500/60 w-full"
                                   placeholder="0812-3456-7890">
                        </div>
                        @error('No_WA') <p class="text-sm text-red-600 w-full text-left">{{ $message }}</p> @enderror
                    </div>

                    <div data-layer="Tanggal Pernikahan" class="TanggalPernikahan self-stretch flex flex-col justify-start items-start gap-1.5">
                        <div data-layer="Label" class="Label self-stretch flex flex-col justify-start items-start">
                            <div data-layer="Rencana Tanggal Pernikahan *" class="RencanaTanggalPernikahan self-stretch justify-center"><span class="text-neutral-900 text-base font-semibold font-['Inter'] leading-6">Rencana Tanggal Pernikahan </span><span class="text-red-700 text-base font-semibold font-['Inter'] leading-6">*</span></div>
                        </div>
                        <div data-layer="Input" class="Input self-stretch bg-stone-50 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300 flex justify-center items-center overflow-hidden focus-within:outline-neutral-900">
                            <input type="date" name="Tanggal_acara" value="{{ old('Tanggal_acara') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   class="flex-1 px-3.5 py-2.5 bg-transparent border-none outline-none focus:ring-0 text-neutral-900 text-base font-normal font-['Inter'] w-full">
                        </div>
                        @error('Tanggal_acara') <p class="text-sm text-red-600 w-full text-left">{{ $message }}</p> @enderror
                    </div>

                    <div data-layer="Catatan / Lokasi" class="CatatanLokasi self-stretch pb-1.5 flex flex-col justify-start items-start gap-1.5">
                        <div data-layer="Label" class="Label self-stretch flex flex-col justify-start items-start">
                            <div data-layer="Lokasi Acara & Catatan Khusus" class="LokasiAcaraCatatanKhusus self-stretch justify-center text-neutral-900 text-base font-semibold font-['Inter'] leading-6">Lokasi Acara & Catatan Khusus</div>
                        </div>
                        <div data-layer="Textarea" class="Textarea self-stretch bg-stone-50 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300 flex justify-center items-start overflow-hidden focus-within:outline-neutral-900">
                            <textarea name="Catatan" rows="3"
                                      class="flex-1 px-3.5 py-3 bg-transparent border-none outline-none focus:ring-0 text-neutral-900 text-base font-normal font-['Inter'] placeholder:text-stone-500/60 w-full resize-y"
                                      placeholder="Contoh: Gedung Pernikahan / Rumah di Jakarta Selatan. Preferensi nuansa adat atau modern...">{{ old('Catatan') }}</textarea>
                        </div>
                        @error('Catatan') <p class="text-sm text-red-600 w-full text-left">{{ $message }}</p> @enderror
                    </div>

                    <div data-layer="Action Buttons" class="ActionButtons self-stretch pt-3 flex flex-col sm:flex-row justify-start items-center gap-3">
                        <a href="{{ route('katalog') }}" data-layer="Link" class="Link w-full sm:w-auto px-5 py-2.5 rounded-sm outline outline-1 outline-offset-[-1px] outline-stone-300 inline-flex flex-col justify-start items-center hover:bg-stone-50 transition">
                            <div data-layer="Text" class="Text text-center justify-center text-zinc-900 text-base font-normal font-['Inter'] leading-6">Batal / Kembali</div>
                        </a>
                        <button type="submit" data-layer="Button" class="Button w-full sm:flex-1 px-6 py-2.5 bg-neutral-900 hover:bg-neutral-800 transition rounded-sm shadow-[0px_1px_2px_0px_rgba(0,0,0,0.05)] inline-flex flex-col justify-center items-center">
                            <div data-layer="Text" class="Text text-center justify-center text-white text-base font-semibold font-['Inter'] leading-6">Kirim Pesanan</div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-public-layout>
