import auth from './auth/routes'
import home from './home/routes'
import timeline from './timeline/routes'
import account from './account/routes'
import portfolio from './portfolio/routes'
import admin from './admin/routes'
import errors from './errors/routes'

export default [...home, ...auth, ...timeline, ...account, ...portfolio, ...admin, ...errors]