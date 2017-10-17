@extends('layouts.app')

@section('content')


    <section style="background-color: #f9f9f9;">

		<div class="container-fluid">

			<div class="col-xs-12 col-md-12 col-lg-12">
				<div class="about" >
					<img src="{{ asset('img/latte-ico.png') }}" alt="papa" class="abb">

					<p>Steve Jobs (Founder of Apple Inc) once said
						"Everybody in this country must learn how
						to program a computer because it teaches you
						how to think ".So the Code Latte created,
						it is an E-learning system that will help
						encourage everyone that want to make things
						probably easy. I’m El Miguel commonly
						known as Migz - individual with passion for
						learning and coding — coding makes me happy.
						I truly believe that learning how to code
						has a big influence in every bodies daily life
						but it doesn’t mean that everyone must work as
						a developer or programmer. Coding thought everyone
						to solve different problem like how you think what's
						the error on your program? Otherwise how to boost your
						critical thinking under pressure like how you think the correct
						syntax. In short you creating yourself as a solution-driven individual. </p>
					<br>
					<br>
					<p>El Miguel A. Marcaida</p>
					<p>(Founder of Code Latte)</p>


				</div>
			</div>

		</div>

	</section>


    @include('includes.data-stuff')
    @include('includes.trial-stuff')
    @include('includes.footer')
@endsection


