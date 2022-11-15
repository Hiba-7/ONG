@props(['percentage' => 20])

@php
    $color = $percentage <= 65 ? 'warning' : 'green';
    $color = $percentage > 65 && $percentage != 100 ? 'green' : 'warning';
    $color = $percentage == 100 ? 'blue' : ($percentage <= 65 ? 'warning' : 'green');

@endphp

<div {{ $attributes->merge(['class' => '']) }}>
    <svg viewBox="0 0 36 36" class="circular-chart {{ $color }}">
        <path class="circle-bg"
            d="M18 2.0845
            a 15.9155 15.9155 0 0 1 0 31.831
            a 15.9155 15.9155 0 0 1 0 -31.831" />
        <path class="circle" stroke-dasharray="{{ $percentage }}, 100"
            d="M18 2.0845
            a 15.9155 15.9155 0 0 1 0 31.831
            a 15.9155 15.9155 0 0 1 0 -31.831" />
        <text x="18" y="20.35" class="percentage">{{ $percentage }}%</text>
    </svg>
</div>
<style>
    .circular-chart {
        max-width: 45%;
        max-height: 250px;
    }

    .circle-bg {
        fill: none;
        stroke: #eee;
        stroke-width: 3.8;
    }

    .circle {
        fill: none;
        stroke-width: 2.8;
        stroke-linecap: round;
        animation: progress 1s ease-out forwards;
    }

    @keyframes progress {
        0% {
            stroke-dasharray: 0 100;
        }
    }

    .circular-chart.warning .circle {
        stroke: #FACC15;
        ;
    }

    .circular-chart.green .circle {
        stroke: #4CC790;
    }

    .circular-chart.blue .circle {
        stroke: #3c9ee5;
    }

    .percentage {
        fill: #666;
        font-family: sans-serif;
        font-size: 0.5em;
        text-anchor: middle;
    }
</style>
