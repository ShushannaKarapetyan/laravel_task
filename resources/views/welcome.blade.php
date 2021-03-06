@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="banner-section">
                <div class="banner">
                    <div class="container">
                        <div class="banner-details">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Error, incidunt, placeat. Commodi
                            eaque est exercitationem id magni odit optio quod!
                            <hr>
                            Lorem ipsum dolor sit amet.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="properties">
        <div class="container">
            <div class="featured-properties-title">
                <h3>Featured Properties</h3>
                <hr>
            </div>
            <div class="row">
                @foreach($properties as $key=>$property)
                    <div class="col-md-3 col-lg-4 col-sm-6">
                        <div class="card">
                            <a href="#">
                                <img class="card-img-top property-image" src="{{ asset('images/property2.jpg') }}"
                                     alt="">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title property-title">{{ $property["name_{$locale}"] }}</h5>
                                <p class="property-address">{{ $property['address'] }}</p>
                                <p class="card-text property-description">{{$property["description_{$locale}"] }}</p>
                                <strong class="property-price">$ {{ $property['price'] }}</strong>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="reviews">
        <div class="container">
            <div class="reviews-title">
                <h3>Reviews</h3>
                <hr>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="reviews-section-img">
                        <img src="{{ asset('images/write-notes.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="review">
                        <div class="user-image">
                            <img src="{{ asset('images/user1.png') }}" alt="">
                        </div>
                        <div class="review-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet culpa ea eveniet modi neque
                            nostrum omnis quia, quisquam quo quos sapiente, soluta tenetur. Eos illo in ipsa perferendis
                            quas. Aliquid!
                        </div>
                        <div class="user-name">
                            <strong>
                                Some Name
                            </strong>
                        </div>
                    </div>
                    <hr>
                    <div class="review">
                        <div class="user-image">
                            <img src="{{ asset('images/user2.png') }}" alt="">
                        </div>
                        <div class="review-text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet culpa ea eveniet modi
                                neque
                                nostrum omnis quia, quisquam quo quos sapiente, soluta tenetur. Eos illo in ipsa
                                perferendis
                                quas. Aliquid!</p>
                        </div>
                        <div class="user-name">
                            <strong>
                                Some Name
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="resent-posts">
        <div class="container-fluid">
            <div class="resent-posts-title">
                <h3>Recent Posts</h3>
                <hr>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="post-image">
                                    <img src="{{ asset('images/posts/post1.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="post-info">
                                    <h3>Properties In Beverly Hills</h3>
                                    <p class="date">August 17, 2019</p>
                                    <p class="info-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab
                                        aut beatae blanditiis fugit molestias perspiciatis praesentium sapiente soluta
                                        unde vel! Ab alias assumenda dolore facilis in labore nostrum quasi saepe vitae!
                                        A accusamus aliquid at cupiditate ipsa iste minus molestiae nam, perspiciatis
                                        quam quasi quo quod quos reprehenderit rerum velit!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="post-image">
                                    <img src="{{ asset('images/posts/post2.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="post-info">
                                    <h3>Properties in Beverly Hills</h3>
                                    <p class="date">August 17, 2019</p>
                                    <p class="info-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab
                                        aut beatae blanditiis fugit molestias perspiciatis praesentium sapiente soluta
                                        unde vel! Ab alias assumenda dolore facilis in labore nostrum quasi saepe vitae!
                                        A accusamus aliquid at cupiditate ipsa iste minus molestiae nam, perspiciatis
                                        quam quasi quo quod quos reprehenderit rerum velit!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="post-info">
                                    <h3>Properties in Beverly Hills</h3>
                                    <p class="date">August 17, 2019</p>
                                    <p class="info-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab
                                        aut beatae blanditiis fugit molestias perspiciatis praesentium sapiente soluta
                                        unde vel! Ab alias assumenda dolore facilis in labore nostrum quasi saepe vitae!
                                        A accusamus aliquid at cupiditate ipsa iste minus molestiae nam, perspiciatis
                                        quam quasi quo quod quos reprehenderit rerum velit!</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="post-image">
                                    <img src="{{ asset('images/posts/post3.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="post-info">
                                    <h3>Properties in Beverly Hills</h3>
                                    <p class="date">August 17, 2019</p>
                                    <p class="info-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab
                                        aut beatae blanditiis fugit molestias perspiciatis praesentium sapiente soluta
                                        unde vel! Ab alias assumenda dolore facilis in labore nostrum quasi saepe vitae!
                                        A accusamus aliquid at cupiditate ipsa iste minus molestiae nam, perspiciatis
                                        quam quasi quo quod quos reprehenderit rerum velit!</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6-col-sm-12">
                                <div class="post-image">
                                    <img src="{{ asset('images/posts/post4.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-team">
        <div class="container">
            <div class="team-title">
                <h3>Our team</h3>
                <hr>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="member-image">
                            <a href="">
                                <img class="card-img-top" src="{{ asset('images/team-members/member1.jpeg') }}"
                                     alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title member-name">Member 1</h5>
                            <p class="position">Douglas And Eleman Agency</p>
                            <p class="card-text about-member">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Accusamus consectetur cupiditate, deserunt est ex modi.</p>
                            <div class="view-profile-btn">
                                <button class="btn">View Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="member-image">
                            <a href="">
                                <img class="card-img-top" src="{{ asset('images/team-members/member2.jpeg') }}"
                                     alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title member-name">Member 2</h5>
                            <p class="position">Property Owner</p>
                            <p class="card-text about-member">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Accusamus consectetur cupiditate, deserunt est ex modi.</p>
                            <div class="view-profile-btn">
                                <button class="btn">View Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-6">
                    <div class="card">
                        <div class="member-image">
                            <a href="">
                                <img class="card-img-top" src="{{ asset('images/team-members/member3.png') }}"
                                     alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title member-name">Member 3</h5>
                            <p class="position">Douglas And Eleman Agency</p>
                            <p class="card-text about-member">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Accusamus consectetur cupiditate, deserunt est ex modi.</p>
                            <div class="view-profile-btn">
                                <button class="btn">View Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
