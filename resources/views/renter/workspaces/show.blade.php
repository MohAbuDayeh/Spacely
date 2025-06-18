@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <style>
        /* تحسينات عامة لتتناسب مع التصميم */
        .workspace-detail-section {
            padding: 60px 0;
        }

        .workspace-gallery {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .workspace-gallery .slick-slide img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        .workspace-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 4px;
            z-index: 2;
        }

        .featured-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--primary);
            color: white;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 4px;
            z-index: 2;
        }

        .workspace-nav {
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .workspace-nav ul {
            display: flex;
            padding: 0;
            margin: 0;
            list-style: none;
            overflow-x: auto;
        }

        .workspace-nav li {
            flex: 1;
            text-align: center;
        }

        .workspace-nav a {
            display: block;
            padding: 15px 10px;
            color: #6c757d;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .workspace-nav a:hover,
        .workspace-nav a.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .workspace-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .workspace-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .workspace-card-img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .workspace-card:hover .workspace-card-img {
            transform: scale(1.05);
        }

        .amenities-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .amenity-item {
            display: flex;
            align-items: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .amenity-item i {
            margin-right: 10px;
            color: var(--primary);
        }

        .review-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
        }

        .sidebar-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .sidebar-card-header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            font-weight: 600;
        }

        #detailMap {
            height: 300px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .price-highlight {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .host-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
        }

        .section-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary);
        }

        @media (max-width: 768px) {
            .workspace-nav ul {
                flex-wrap: nowrap;
                white-space: nowrap;
            }

            .workspace-nav li {
                flex: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="workspace-detail-section bg-light">
        <div class="container">
            <!-- معرض الصور -->
            <div class="workspace-gallery">
                <div class="listing-slider">
                    @foreach (json_decode($workspace->images) as $image)
                        <div class="item">
                            <img src="{{ asset('storage/' . $image) }}" alt="Workspace Image" class="w-100">
                        </div>
                    @endforeach
                </div>

                @if ($workspace->is_featured)
                    <span class="featured-badge">Featured</span>
                @endif

                <span class="workspace-badge badge bg-{{ $workspace->type_color }}">
                    {{ $workspace->type_name }}
                </span>
            </div>

            <!-- شريط التنقل بين الأقسام -->
            <div class="workspace-nav">
                <ul>
                    <li><a class="page-scroll active" href="#overview">Overview</a></li>
                    <li><a class="page-scroll" href="#amenities">Amenities</a></li>
                    <li><a class="page-scroll" href="#reviews">Reviews</a></li>
                    @if ($workspace->video_url)
                        <li><a class="page-scroll" href="#video">Video</a></li>
                    @endif
                    <li><a class="page-scroll" href="#location">Location</a></li>
                    <li><a class="page-scroll" href="#similar">Similar Spaces</a></li>
                </ul>
            </div>

            <div class="row">
                <!-- المحتوى الرئيسي -->
                <div class="col-lg-8">
                    <!-- نظرة عامة -->
                    <div class="card workspace-card" id="overview">
                        <div class="card-body p-5">
                            <h1 class="mb-3">{{ $workspace->title }}</h1>
                            <p class="text-muted mb-4">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                {{ $workspace->location }}
                            </p>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary-soft rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-calendar-alt text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">{{ $workspace->minimum_term }}
                                                {{ $workspace->minimum_term_unit }}</h5>
                                            <p class="text-muted mb-0">Minimum term</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary-soft rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-vector-square text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">{{ $workspace->size }} SqFt</h5>
                                            <p class="text-muted mb-0">Size</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary-soft rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-users text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">{{ $workspace->people_capacity }}</h5>
                                            <p class="text-muted mb-0">People</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary-soft rounded-circle d-flex align-items-center justify-content-center me-3"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-chair text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">{{ $workspace->space_type }}</h5>
                                            <p class="text-muted mb-0">Space Type</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="section-title">Description</h4>
                            <p class="mb-0">{{ $workspace->description }}</p>
                        </div>
                    </div>

                    <!-- المرافق -->
                    <div class="card workspace-card" id="amenities">
                        <div class="card-body p-5">
                            <h4 class="section-title">Amenities</h4>
                            <div class="amenities-list">
                                @foreach ($workspace->amenities as $amenity)
                                    <div class="amenity-item">
                                        <i class="far fa-check-circle"></i>
                                        <span>{{ $amenity->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- الفيديو (إذا موجود) -->
                    @if ($workspace->video_url)
                        <div class="card workspace-card" id="video">
                            <div class="card-body p-5">
                                <h4 class="section-title">Video Tour</h4>
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $workspace->video_url }}" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- التقييمات -->
                    <div class="card workspace-card" id="reviews">
                        <div class="card-body p-5">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="section-title mb-0">Reviews ({{ $workspace->reviews_count }})</h4>
                                <a href="#review-form" class="btn btn-primary page-scroll">Write a Review</a>
                            </div>

                            @foreach ($workspace->reviews as $review)
                                <div class="review-card">
                                    <div class="d-flex align-items-center mb-3">
                                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/images/profile.jpn.webp') }}"
                                            alt="{{ $review->user->name }}" class="rounded-circle me-3" width="50">
                                        <div>
                                            <h5 class="mb-1">{{ $review->user->name }}</h5>
                                            <div class="d-flex align-items-center">
                                                <div class="star-rating me-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $review->rating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @elseif($i - 0.5 <= $review->rating)
                                                            <i class="fas fa-star-half-alt text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-warning"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span
                                                    class="text-muted small">{{ $review->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="mb-2">{{ $review->title }}</h6>
                                    <p class="mb-0">{{ $review->content }}</p>
                                </div>
                            @endforeach

                            <!-- نموذج التقييم -->
                            <div id="review-form">
                                <h4 class="section-title mt-5">Write a Review</h4>
                                <form method="POST" action="{{ route('renter.reviews.store', $workspace->id) }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="hidden" name="user_id" id="" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="workspace_id" id="" value="{{ $workspace->id }}">
                                        <label for="rating" class="form-label">Rating</label>
                                        <select name="rating" id="rating" class="form-select" required>
                                            <option value="">Select Rating</option>
                                            <option value="5">5 Stars - Excellent</option>
                                            <option value="4">4 Stars - Very Good</option>
                                            <option value="3">3 Stars - Good</option>
                                            <option value="2">2 Stars - Fair</option>
                                            <option value="1">1 Star - Poor</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Review Title</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Your Review</label>
                                        <textarea name="comment" id="comment" rows="4" class="form-control" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- الموقع -->
                    <div class="card workspace-card" id="location">
                        <div class="card-body p-5">
                            <h4 class="section-title">Location</h4>
                            <p class="mb-4">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                {{ $workspace->location }}
                            </p>

                        </div>
                    </div>
                </div>


                <div class="col-lg-4">

                    <div class="sidebar-card">
                        <div class="sidebar-card-header">
                            Pricing
                        </div>
                        <div class="card-body text-center p-4">
                            <div class="price-highlight mb-3">
                                {{ number_format($workspace->price_per_month) }} JOD
                                <span class="text-muted fs-6">/month</span>
                            </div>

                            @if ($workspace->price_per_day)
                                <p class="mb-1">
                                    <span class="text-muted">Daily:</span>
                                    <span class="fw-bold">{{ $workspace->price_per_day }} JOD</span>
                                </p>
                            @endif

                            @if ($workspace->price_per_hour)
                                <p class="mb-1">
                                    <span class="text-muted">Hourly:</span>
                                    <span class="fw-bold">{{ $workspace->price_per_hour }} JOD</span>
                                </p>
                            @endif

                            <a href="{{ route('renter.payment.show', $workspace->id) }}"
                                class="btn btn-primary btn-lg w-100 mt-3 hover-scale">
                                Book Now
                            </a>
                        </div>
                    </div>

                    <!-- تواريخ الحجز -->
                    <div class="sidebar-card">
                        <div class="sidebar-card-header">
                            Availability
                        </div>
                        <div class="card-body p-4">
                            <div id="datepicker-inlin"></div>
                        </div>
                    </div>

                    <!-- مالك المساحة -->
                    <div class="sidebar-card">
                        <div class="sidebar-card-header">
                            Contact Host
                        </div>
                        <div class="card-body text-center p-4">
                            <img src="{{ asset('assets/images/profile.jpn.webp') }}" alt="{{ $workspace->user->name }}"
                                class="host-avatar mb-3">
                            <h5 class="mb-2">{{ $workspace->user->name }}</h5>
                            <p class="text-muted mb-3">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $workspace->location }}
                            </p>
                            <a href="tel:{{ $workspace->user->phone }}" class="btn btn-outline-primary w-100 mb-2">
                                <i class="fas fa-phone-alt me-2"></i> {{ $workspace->user->phone }}
                            </a>
                            <a href="mailto:{{ $workspace->user->email }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-envelope me-2"></i> Send Message
                            </a>
                        </div>
                    </div>

                    <!-- طلب عرض سعر -->
                    <div class="sidebar-card">
                        <div class="sidebar-card-header">
                            Request a Quote
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('renter.quotes.store') }}">
                                @csrf
                                <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" name="phone" id="phone" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="datetime" class="form-label">Preferred Date & Time</label>
                                    <input type="datetime-local" name="availability" id="datetime"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Preferred amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control">
                                </div>


                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea name="message" id="message" rows="3" class="form-control"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Send Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- مساحات مشابهة -->
            <div class="row mt-5" id="similar">
                <div class="col-12">
                    <h4 class="section-title">Similar Workspaces</h4>
                </div>

                @foreach ($similarWorkspaces as $similar)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card workspace-card h-100">
                            <div class="position-relative overflow-hidden">
                                <a href="{{ route('renter.workspaces.show', $similar->id) }}">
                                    @php
                                        $images = json_decode($similar->images);
                                        $image = isset($images[0]) ? $images[0] : 'default-workspace.jpg';
                                    @endphp
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $similar->title }}"
                                        class="workspace-card-img w-100">

                                    @if ($similar->is_featured)
                                        <span class="featured-badge">Featured</span>
                                    @endif

                                    <span class="workspace-badge badge bg-{{ $similar->type_color }}">
                                        {{ $similar->space_type }}
                                    </span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="mb-2">
                                    <a href="{{ route('renter.workspaces.show', $similar->id) }}" class="text-dark">
                                        {{ Str::limit($similar->title, 30) }}
                                    </a>
                                </h5>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                    {{ Str::limit($similar->location, 30) }}
                                </p>

                                <div class="mb-3">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $similar->reviews_avg_rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @elseif($i - 0.5 <= $similar->reviews_avg_rating)
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    <small class="ms-1">({{ $similar->reviews_count }})</small>
                                </div>

                                <div class="d-flex justify-content-between border-top pt-3">
                                    <div>
                                        <span class="d-block small text-muted">Price</span>
                                        <span class="font-weight-bold">${{ $similar->price_per_month }}/mo</span>
                                    </div>
                                    <div>
                                        <span class="d-block small text-muted">Capacity</span>
                                        <span class="font-weight-bold">{{ $similar->people_capacity }}</span>
                                    </div>
                                    <div>
                                        <span class="d-block small text-muted">Size</span>
                                        <span class="font-weight-bold">{{ $similar->size }} sq.ft</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/leaflet/dist/leaflet.js') }}"></script>

    <script>
        // Use flatpickr to show date and time picker in the calendar
        flatpickr("#datepicker-inlin", {
            mode: "range",
            enableTime: true,
            noCalendar: false,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            inline: true,
            minDate: "today",
            minuteIncrement: 60,
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    var start = selectedDates[0];
                    var end = selectedDates[1];
                    var diff = (end - start) / (1000 * 60 * 60);
                    if (diff > 24) {
                        instance.clear();
                        alert('Please select a range of up to 24 hours.');
                        return;
                    }
                    // Show start and end hours
                    var startHour = start.getHours().toString().padStart(2, '0') + ':' + start.getMinutes()
                        .toString().padStart(2, '0');
                    var endHour = end.getHours().toString().padStart(2, '0') + ':' + end.getMinutes().toString()
                        .padStart(2, '0');
                    alert('Start: ' + startHour + '\nEnd: ' + endHour);
                }
            }
        });
    </script>
@endsection
