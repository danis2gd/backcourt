import 'slick-carousel';
import 'slick-carousel/slick/slick.less';
import 'slick-carousel/slick/slick-theme.less';
import '../../scss/components/_carousel.scss'

import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Routing from '../base/router';
import Slider from 'react-slick';
import ReactHtmlParser from 'react-html-parser';

class NewsSlider extends Component {
    constructor() {
        super();

        this.state = {
            error: null,
            isLoaded: false,
            items: []
        }
    }

    componentDidMount() {
        fetch(Routing.generate(this.props.endpoint))
            .then(res => res.json())
            .then(
                (result) => {
                    console.log(result);

                    this.setState({
                        isLoaded: true,
                        items: result
                    });
                },
                (error) => {
                    this.setState({
                        isLoaded: true,
                        error
                    });
                }
            )
    }

    render() {
        const settings = {
            arrows: true,
            autoplay: true,
            dots: true,
        };

        const sliders = this.state.items.map((card, key) =>
            <Slide key={key} title={card.title} description={card.description}
                   imagePath={card.imagePath} />
        );

        return (
            <Slider {...settings} className="news-slider">
                {sliders}
            </Slider>
        );
    }
}



class Slide extends Component {
    render() {
        return (
            <div className="slide news-slide">
                <img src={this.props.imagePath} className="d-block" alt={this.props.title}/>
                <div className="overlay">
                    <h2>{ReactHtmlParser(this.props.title)}</h2>
                    <p>{ReactHtmlParser(this.props.description)}</p>
                </div>
            </div>
        );
    }
}

ReactDOM.render(<NewsSlider endpoint='api_carousel_articles' />, document.getElementById('news-slider'));