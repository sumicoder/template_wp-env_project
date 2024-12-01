window.addEventListener('DOMContentLoaded', function () {
    /*===========================
	// MARK: webp 背景で使用
	===========================*/

    /**
     * ブラウザが webp をサポートしているかどうか
     *
     * @returns webp をサポートしているなら true そうでないなら false
     */
    const supportsWebp = async () => {
        if (!self.createImageBitmap) return false;
        // webp の仮データ
        const webpData = 'data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAAAAAAfQ//73v/+BiOh/AAA=';
        const blob = await fetch(webpData).then((r) => r.blob());
        return createImageBitmap(blob).then(
            () => true,
            () => false
        );
    };
    /**
     * webp 対応していれば target に is-webp、対応していなければ is-no-webp クラスを追加する
     *
     * @param {string} target (default: body)
     */
    const addWebpDetectionClass = (target = 'body') => {
        if (supportsWebp()) {
            $(target).addClass('is-webp');
        } else {
            $(target).addClass('is-no-webp');
        }
    };

    addWebpDetectionClass(); // 実行

    /*===========================
	// MARK: resize
	===========================*/
    const mdSize = 768;
    const mediaQueryList = window.matchMedia(`(min-width: ${mdSize}px)`);
    mediaQueryList.addEventListener('change', (event) => {
        if (event.matches) {
            location.reload();
        } else {
            location.reload();
        }
    });

    /*===========================
	// MARK: header
	===========================*/
    // drawer
    const hamburgerBtn = document.querySelector('[data-button="hamburger"]');
    const drawerCloseBtn = document.querySelector('[data-button="drawer-close"]');
    const hamburgerTrigger = document.querySelector('[data-drawer-status]');
    const body = document.querySelector('body');
    const headerDrawer = document.querySelector('[data-header-drawer]');

    hamburgerBtn.addEventListener('click', tabToggle);
    drawerCloseBtn.addEventListener('click', tabToggle);
    function tabToggle() {
        hamburgerTrigger.dataset.drawerStatus = hamburgerTrigger.dataset.drawerStatus == 'open' ? 'close' : 'open';
        body.classList.toggle('is-fixed');

        if (hamburgerTrigger.dataset.drawerStatus == 'open') {
            headerDrawer.scrollTop = 0;
            headerDrawer.removeAttribute('inert');
        } else {
            headerDrawer.setAttribute('inert', '');
        }
    }

    /*===========================
	// MARK: フェードイン
	===========================*/
    const fadeInItems = gsap.utils.toArray('.js-fadeIN');
    if (fadeInItems.length > 0) {
        fadeInItems.forEach((fadeItem) => {
            gsap.from(fadeItem, {
                y: 50,
                autoAlpha: 0,
                duration: 0.6,
                scrollTrigger: {
                    trigger: fadeItem,
                    start: 'top top+=90%',
                },
            });
        });
    }

    /*===========================
	// MARK: CSSアニメーション
	===========================*/
    const animationElems = gsap.utils.toArray('[data-animation-status]');
    if (animationElems.length > 0) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.intersectionRatio > 0.2) {
                        entry.target.setAttribute('data-animation-status', 'play');
                    }
                });
            },
            { threshold: [0.4] }
        );
        animationElems.forEach((element) => {
            if (element instanceof Element) {
                observer.observe(element);
            }
        });
    }

    /*===========================
	// MARK: アンカースクロール
	===========================*/
    const smoothScroll = (hash, offset = 0, target = window) => {
        gsap.to(target, {
            duration: 0.8,
            ease: 'power4.out',
            scrollTo: {
                y: hash,
                autoKill: false,
                offsetY: offset,
            },
        });
    };
    const anchors = document.querySelectorAll('a[href^="#"]');
    anchors.forEach((anchor) => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            smoothScroll(anchor.hash);
        });
    });

    /*===========================
	// MARK: シェアボタン/タップしたらコピー
	===========================*/
    const copyBtn = document.querySelector('[data-copy-btn]');
    if (copyBtn != null) {
        copyBtn.addEventListener('click', async (event) => {
            const postTitle = copyBtn.getAttribute('data-post-title');
            const postUrl = copyBtn.getAttribute('data-post-url');
            if (navigator.share) {
                try {
                    await navigator.share({
                        title: postTitle, // 投稿のタイトル
                        text: '', // シェア時に表示するテキスト
                        url: postUrl, // 投稿のURL
                    });
                    console.log('共有成功');
                } catch (error) {
                    console.error('共有に失敗しました', error);
                }
            } else {
                alert('このブラウザは共有機能をサポートしていません');
                if (!navigator.clipboard) {
                    alert('このブラウザではコピー機能がサポートされていません。');
                    return;
                }
                navigator.clipboard
                    .writeText(postTitle + '\n' + postUrl)
                    .then(() => {
                        alert('この記事「' + postTitle + '」のURLをコピーしました');
                    })
                    .catch((err) => {
                        console.error('コピーに失敗しました: ', err);
                        alert('コピーに失敗しま');
                    });
            }
        });
    }
});
