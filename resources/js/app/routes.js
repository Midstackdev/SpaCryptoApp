import auth from './auth/routes'
import home from './home/routes'
import timeline from './timeline/routes'
import account from './account/routes'
import errors from './errors/routes'

export default [...home, ...auth, ...timeline, ...account, ...errors]