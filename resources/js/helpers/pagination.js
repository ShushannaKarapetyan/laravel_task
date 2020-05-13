class Pagination {
    constructor() {
        this.paginate = {};
    }

    makePagination(data) {
        this.paginate = {
            current_page: data.current_page,
            last_page: data.last_page,
            next_page_url: data.next_page_url,
            prev_page_url: data.prev_page_url
        }
    }
}

export default Pagination;
